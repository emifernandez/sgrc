<head>
    <link rel="stylesheet" href="/css/app.css">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
</head>
<script src="/js/app.js"></script>
@if ($errors->any())
<script type="text/javascript">
    toastr.error('Por favor verifique el formulario', 'No se pudo grabar los datos' , {timeOut: 5000})
</script>
@endif

@if ($message = Session::get('success'))
<script type="text/javascript">
    toastr.success('<?php echo $message; ?>', 'Exito', {timeOut: 5000})
</script>
<?php Session::forget('success');?>
@endif

@if ($message = Session::get('error'))
<script type="text/javascript">
    toastr.error('<?php echo $message; ?>', 'Error', {timeOut: 5000})
</script>
<?php Session::forget('error');?>
@endif

@if ($message = Session::get('warning'))
<script type="text/javascript">
    toastr.warning('<?php echo $message; ?>', 'Alerta', {timeOut: 5000})
</script>
<?php Session::forget('warning');?>
@endif

@if ($message = Session::get('info'))
<script type="text/javascript">
    toastr.info('<?php echo $message; ?>', 'Informacion', {timeOut: 5000})
</script>
<?php Session::forget('info');?>
@endif
