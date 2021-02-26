function Table_AlumnosClase() {
    // var idclase = document.getElementById('idclase').value;
    var idclase = document.getElementById('idclase').value;
    $('#alumnos_clase').DataTable({
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
            url: '../../alumnos_clase',
            data: { idclase: idclase },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data: 'imagen',
                name: 'imagen'
            },
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'telefono',
                name: 'telefono'
            },
            {
                data: 'direccion',
                name: 'direccion'
            },

        ]
    });
}

$(document).ready(function () {
    Table_AlumnosClase();
});