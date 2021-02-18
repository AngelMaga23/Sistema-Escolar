function TableForo() {

    var idclase = document.getElementById('clase_asignatura').value;
    $('#foro_table').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        responsive: true,
        "language": {

            "decimal": "",

            "emptyTable": "No hay datos disponibles en la tabla",

            "info": "Mostrando _START_ a _END_ de _TOTAL_ datos",

            "infoEmpty": "Mostrando 0 de 0 de 0 datos",

            "infoFiltered": "(Filtrados de  _MAX_ registros totales)",

            "infoPostFix": "",

            "thousands": ",",

            "lengthMenu": "Mostrar _MENU_ datos",

            "loadingRecords": "Cargando...",

            "processing": "Procesando...",

            "search": "Buscar:",

            "zeroRecords": "No se encontraron registros coincidentes",

            "paginate": {

                "first": "First",

                "last": "Last",

                "next": "Siguiente",

                "previous": "Atras"

            },


            "aria": {

                "sortAscending": ": activate to sort column ascending",

                "sortDescending": ": activate to sort column descending"

            }

        },
        ajax: {
            type: 'post',
            url: '../../foro_asig_index',
            data: { idclase: idclase },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'descripcion',
                name: 'descripcion'
            },
            {
                data: 'action',
                name: 'action'
            },

        ]
    });
}

function Delete_Foro(id) {
    swal({
        title: "Eliminar foro",
        text: "¿Estás seguro?",
        icon: "warning",
        buttons: ["Cancelar", "Continuar"],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '../../foro_delete',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id": id
                    },

                    success: function (response) {
                        if (response.message == "ok") {
                            message_succesfully_Foro_delete();
                            $('#foro_table').DataTable().ajax.reload();
                        }

                        else {
                            message_errorU(response.message);
                        }
                    },
                });
            }
            else {
                // swal("Operación cancelada.");
            }
        });
}


$(document).ready(function () {
    TableForo();



  

});