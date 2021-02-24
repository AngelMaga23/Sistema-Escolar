function Table_Entregas() {
    // var idclase = document.getElementById('idclase').value;
    var idtarea = document.getElementById('idtarea').value;
    $('#entregas_table').DataTable({
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
            url: '../../../entregas_index',
            data: { idtarea: idtarea },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data:'alumno',
                name:'alumno'
            },
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'descripcion',
                name: 'descripcion'
            },
            {
                data: 'calificacion',
                name: 'calificacion'
            },
            {
                data: 'estatu',
                name: 'estatu'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action'
            },

        ]
    });
}

function Entrega(dato) {
    var options = {
        modal: true,
        height: 300,
        width: 600
    };

    $('#content_modal').html('<div class="preloader"><img src="images/91.gif" alt="loading" width="50" height="50" /><br/></div>');
    $('#content_modal').load('../../entrega/' + dato, function () {
        $('#exampleModal').modal({ show: true });
        // Table_Archivos();
    });
}

function Add_Coment_Tarea()
{

    var identrega = document.getElementById('identrega').value;
    var mensaje = document.getElementById('coment_profesor').value;

    $.ajax({
        url: '../../add_comente_entrega',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "identrega":identrega,
            "mensaje":mensaje
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                Entrega(identrega);
            }

            else{
                message_errorU(response.message);
            }
        },
    });
}

function Del_coment_Tarea(id)
{
    var identrega = document.getElementById('identrega').value;
    $.ajax({
        url: '../../del_comente_entrega',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":id,
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                Entrega(identrega);
            }

            else{
                message_errorU(response.message);
            }
        },
    });
}

function EntregaCal(dato) {
    var options = {
        modal: true,
        height: 300,
        width: 600
    };

    $('#content_modal_calificacion').html('<div class="preloader"><img src="images/91.gif" alt="loading" width="50" height="50" /><br/></div>');
    $('#content_modal_calificacion').load('../../calificacion/' + dato, function () {
        $('#mdCalificacion').modal({ show: true });
        // Table_Archivos();
    });
}

function Calificar()
{

    var identrega = document.getElementById('identrega_cal').value;
    var cal = document.getElementById('calificacion').value;

    $.ajax({
        url: '../../calificar',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "identrega":identrega,
            "cal":cal
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                $('#mdCalificacion').modal('hide');
                $('#entregas_table').DataTable().ajax.reload();
            }

            else{
                message_errorU(response.message);
            }
        },
    });
}

$(document).ready(function () {
    Table_Entregas();



});