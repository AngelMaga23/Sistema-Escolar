function Table_ClaseAsignatura() {
    // var idclase = document.getElementById('idclase').value;
    var idclase = document.getElementById('clase_asignatura').value;
    $('#clase_asignatura_table').DataTable({
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
            url: '../../public_asig_index',
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
                data: 'tipo',
                name: 'tipo'
            },
            {
                data: 'action',
                name: 'action'
            },

        ]
    });
}

function Delete_Publicacion(id) {
    swal({
        title: "Eliminar publicación",
        text: "¿Estás seguro?",
        icon: "warning",
        buttons: ["Cancelar", "Continuar"],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '../../public_delete',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "idpublic": id
                    },

                    success: function (response) {
                        if (response.message == "ok") {
                            message_succesfully_Public_delete();
                            $('#clase_asignatura_table').DataTable().ajax.reload();
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

function Table_Archivos() {
    var idpublic = document.getElementById('idpublic').value;
    $('#files_table').DataTable({
        paging: false,
        lengthChange: false,
        searching: false,
        ordering: false,
        info: false,
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
            url: '../../index_files',
            data: { id: idpublic },
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
                data: 'action',
                name: 'action'
            },

        ]
    });
}

function Archivos(dato) {
    var options = {
        modal: true,
        height: 300,
        width: 600
    };

    $('#content_modal').html('<div class="preloader"><img src="../../img/91.gif" alt="loading" width="50" height="50" /><br/></div>');
    $('#content_modal').load('../../archivo-publics/' + dato, function () {
        $('#exampleModal').modal({ show: true });
        Table_Archivos();
    });
}

function Comentarios(dato) {
    var options = {
        modal: true,
        height: 300,
        width: 600
    };

    $('#coments_content_modal').html('<div class="preloader"><img src="../../img/91.gif" alt="loading" width="50" height="50" /><br/></div>');
    $('#coments_content_modal').load('../../coments/' + dato, function () {
        $('#coments').modal({ show: true });
    });
}

function Delete_File(id) {
    swal({
        title: "Eliminar archivo",
        text: "¿Estás seguro?",
        icon: "warning",
        buttons: ["Cancelar", "Continuar"],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '../../file_delete',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id": id
                    },

                    success: function (response) {
                        if (response.message == "ok") {
                            // message_succesfully_Public_delete();
                            $('#files_table').DataTable().ajax.reload();
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
    Table_ClaseAsignatura();



  

});