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