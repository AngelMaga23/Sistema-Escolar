function TableEvaluacion() {

    var idclase = document.getElementById('clase_asignatura').value;
    $('#evaluacion_table').DataTable({
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
            url: '../../evaluacion/alumno_eval_index',
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
                data: 'puntos',
                name: 'puntos'
            },
            {
                data: 'restante',
                name: 'restante'
            },
            {
                data: 'tarde',
                name: 'tarde'
            },
            {
                data:'updated_at',
                name:'updated_at'
            }
        ]
    });
}

$(document).ready(function () {
    TableEvaluacion();
});