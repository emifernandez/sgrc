<?php

namespace App\Mail;

use App\Barrio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Derivacion;
use App\Enfermedad;
use App\EspecialidadMedica;
use App\Establecimiento;
use App\Paciente;
use App\Funcionario;
use App\Distrito;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = $this->details['template'];
        $data = collect([]);
        if ($this->details['template'] == 'referenciaMail' || $this->details['template'] == 'contrarreferenciaMail') {
            $data = Derivacion::find($this->details['value']);
            $data->establecimiento = Establecimiento::find($data->establecimiento);
            $data->establecimiento_derivacion = Establecimiento::find($data->establecimiento_derivacion);
            $data->paciente = Paciente::find($data->paciente);
            $data->profesional_derivante = Funcionario::find($data->profesional_derivante);
            $data->profesional_derivado = Funcionario::find($data->profesional_derivado);
            $data->especialidad = EspecialidadMedica::find($data->especialidad);
            $prioridades = Derivacion::PRIORIDAD_DERIVACION;
            $data->cie_derivacion = Enfermedad::find($data->cie_derivacion);
            $data->prioridad = $prioridades[$data->prioridad];
        }
        return $this->subject($this->details['subject'])->view('emails.' . $template)->with('data', $data);
    }
}
