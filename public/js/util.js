$(document).ready(function () {
    $('.tabla-simple').DataTable({
        responsive: true,
    });
    $('.addAcceso').on('click', function () {
        addAcceso();
    })
    $("table").on("click", ".eliminar", function () {
        $(this).parent().parent().remove();
    });

    $("#especialidad_admision").change(function () {
        var especialidad = $(this).val();
        var establecimiento = $("#establecimiento").val();
        var from = $("#fecha_admision").val().split("-")
        var dia = new Date(from[2], from[1] - 1, from[0]).getDay() + 1;
        $('#profesional').find('option').not(':first').remove();
        $.ajax({
            url: 'getProfesional/' + establecimiento + '/' + especialidad + '/' + dia,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var len = 0;
                if (response['data'] != null) {
                    len = response['data'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var hd = new Date(response['data'][i].hora_desde); var hh = new Date(response['data'][i].hora_hasta);
                        var hora_desde = hd.getHours() + ':' + (hd.getMinutes() < 10 ? '0' + hd.getMinutes() : hd.getMinutes());
                        var hora_hasta = hh.getHours() + ':' + (hh.getMinutes() < 10 ? '0' + hh.getMinutes() : hh.getMinutes());

                        var horario_id = response['data'][i].horario;
                        var descripcion = response['data'][i].funcionario.nombres + ' ' + response['data'][i].funcionario.apellidos + ' - ' + hora_desde + ' a ' + hora_hasta;

                        var option = "<option value='" + horario_id + "'> " + descripcion + "</option>";
                        $('#profesional').append(option);
                    }
                }
            }
        })
    });

    $("#establecimiento_derivacion").change(function () {
        var establecimiento = $(this).val();
        var especialidad = $("#especialidad_referencia").val();
        var profesional_origen = $("#profesional_derivante").val();
        var from = $("#fecha").val().split("-")
        var dia = new Date(from[2], from[1] - 1, from[0]).getDay() + 1;
        $('#profesional').find('option').not(':first').remove();
        $.ajax({
            url: 'getProfesional/' + establecimiento + '/' + especialidad + '/' + profesional_origen + '/' + dia,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var len = 0;
                if (response['data'] != null) {
                    len = response['data'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var hd = new Date(response['data'][i].hora_desde); var hh = new Date(response['data'][i].hora_hasta);
                        var hora_desde = hd.getHours() + ':' + (hd.getMinutes() < 10 ? '0' + hd.getMinutes() : hd.getMinutes());
                        var hora_hasta = hh.getHours() + ':' + (hh.getMinutes() < 10 ? '0' + hh.getMinutes() : hh.getMinutes());
                        var horario_id = response['data'][i].horario;
                        var profesional_id = response['data'][i].funcionario.funcionario;
                        var descripcion = response['data'][i].funcionario.nombres + ' ' + response['data'][i].funcionario.apellidos + ' - ' + hora_desde + ' a ' + hora_hasta;

                        var option = "<option value='" + horario_id + "'> " + descripcion + "</option>";
                        $('#profesional').append(option);
                    }
                }
            }
        })
    });

    $("#especialidad_referencia").change(function () {
        var especialidad = $(this).val();
        var establecimiento = $("#establecimiento_derivacion").val();
        var profesional_origen = $("#profesional_derivante").val();
        var from = $("#fecha").val().split("-")
        var dia = new Date(from[2], from[1] - 1, from[0]).getDay() + 1;
        $('#profesional').find('option').not(':first').remove();
        $.ajax({
            url: 'getProfesional/' + establecimiento + '/' + especialidad + '/' + profesional_origen + '/' + dia,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var len = 0;
                if (response['data'] != null) {
                    len = response['data'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var hd = new Date(response['data'][i].hora_desde); var hh = new Date(response['data'][i].hora_hasta);
                        var hora_desde = hd.getHours() + ':' + (hd.getMinutes() < 10 ? '0' + hd.getMinutes() : hd.getMinutes());
                        var hora_hasta = hh.getHours() + ':' + (hh.getMinutes() < 10 ? '0' + hh.getMinutes() : hh.getMinutes());
                        var horario_id = response['data'][i].horario;
                        var profesional_id = response['data'][i].funcionario.funcionario;
                        var descripcion = response['data'][i].funcionario.nombres + ' ' + response['data'][i].funcionario.apellidos + ' - ' + hora_desde + ' a ' + hora_hasta;

                        var option = "<option value='" + horario_id + "'> " + descripcion + "</option>";
                        $('#profesional').append(option);
                    }
                }
            }
        })
    });

    function addAcceso() {
        var duplicado = false;
        var a = document.getElementById("acceso");
        var h = document.getElementById("habilitado");
        var acceso = JSON.parse(a.value);
        var table = document.getElementById("tabla-acceso");
        var row = table.insertRow(-1);
        $("tr").each(function () {
            $this = $(this);
            var valor = $this.find("input.item").val();
            if (valor == acceso.acceso) {
                duplicado = true;
                toastr.warning('El acceso ya se encuentra agregado', { timeOut: 5000 })
            }
        });
        if (!duplicado) {
            row.innerHTML = '<td style="display:none;"><input type="text" class="form-control item" name="acceso[]" readonly value="' + acceso.acceso + '"></td>'
                + '<td><input type="text" class="form-control" name="nombre[]" readonly value="' + acceso.nombre + '"></td>'
                + '<td class="text-center" valign="center">'
                + ' <input class="form-check-input" type="checkbox" name="habilitado[]" checked value="' + acceso.acceso + '">'
                + '</td>'
                + '<td><a class="btn btn-danger eliminar" data-toggle="tooltip" title="Eliminar Acceso"><i class="fas fa-trash-alt"></i></a></td>';
            a.value = null;
        }
    }
});