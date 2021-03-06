<?php

namespace App\Traits;

use App\Auditoria;
use App\Barrio;
use App\Distrito;
use App\Establecimiento;
use App\Usuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

trait Login
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $establecimientos = Establecimiento::where('estado', '=', Establecimiento::ESTABLECIMIENTO_ACTIVO)->get();
        return view('auth.login')
            ->with('establecimientos', $establecimientos);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        try {
            $establecimientos = Usuario::findOrFail($request->usuario)->establecimientos;
            if ($establecimientos->contains($request->establecimiento)) {
                if ($this->attemptLogin($request)) {
                    $establecimiento = Establecimiento::find($request->establecimiento);
                    $establecimiento->barrio = Barrio::find($establecimiento->barrio);
                    $establecimiento->barrio->distrito = Distrito::find($establecimiento->barrio->distrito);
                    session(['establecimiento' => $establecimiento]);
                    session(['usuario' => $request->usuario]);
                    $this->insertAuditoria($request->usuario, $establecimiento, 'I');
                    return $this->sendLoginResponse($request);
                }
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withInput($request->only('usuario'))->withErrors([
                'autenticacion' => 'Credenciales incorrectas. Por favor vuelva a introducir los datos.',
            ]);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'clave' => 'required|string',
            'establecimiento' => 'required'
        ], [
            'usuario.required' => 'Debe ingresar un usuario',
            'clave.required' => 'Debe ingresar la contraseña',
            'establecimiento.required' => 'Debe seleccionar un establecimiento para ingresar'
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function  attemptLogin(Request $request)
    {
        $credentials = [
            'usuario' => $request->usuario,
            'password' => $request->clave
        ];
        return $this->guard()->attempt($credentials);
        //return $this->guard()->attempt(
        //    $this->credentials($request)
        //);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'clave');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'usuario';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $usuario = $request->session()->get('usuario');
        $establecimiento = $request->session()->get('establecimiento');
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $this->insertAuditoria($usuario, $establecimiento, 'O');

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Inserta datos en la auditoria
     * @param $accion I=login, O=logout
     */
    private function insertAuditoria($usuario, $establecimiento, $accion)
    {
        $auditoria = new Auditoria();
        $auditoria->fecha_registro = now();
        $auditoria->tabla = 'auditorias';
        $auditoria->accion = $accion;
        $auditoria->descripcion = 'usuario: ' . $usuario . ' | establecimiento: ' . $establecimiento->establecimiento; //usuario|establecimiento
        $auditoria->save();
    }
}
