function Table_Clases()
{
    $('#clases_table').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
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
            type:'post',
            url:'clase_index',
            // data:{sucursal_id:sucursal, almacen_id:almacen},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data:'nom_clase',
                name:'nom_clase'
            },
            {
                data:'profesor_Asig',
                name:'profesor_Asig'
            },

            {
                data:'grupo',
                name:'grupo'
            },
            {
                data:'action',
                name:'action'
            },
    ]
    });
}

function Delete_clase(id)
{
	swal({
		title: "Eliminar clase",
		text: "¿Estás seguro?",
		icon: "warning",
		buttons: ["Cancelar", "Continuar"],
		dangerMode: true,
		})
		.then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: 'clase_delete',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id":id
                    },

                    success:function(response)
                    {
                        if(response.message == "ok")
                        {
                                message_succesfullyDel_user();
                                $('#clases_table').DataTable().ajax.reload();
                        }

                        else{
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

function Table_Clases_Asignaturas()
{
    var idclase = document.getElementById('idclase').value;
    $('#clases_asignaturas_table').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
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
            type:'post',
            url:'../clase_asignaturas_index',
            data:{idclase:idclase},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data:'profesor',
                name:'profesor'
            },
            {
                data:'nombre',
                name:'nombre'
            },
            {
                data:'action',
                name:'action'
            },
    ]
    });
}

function Agregar_asignaturas()
{
    var idclase = document.getElementById('idclase').value;
    var asignatura_id = document.getElementById('asignadura_id').value;
    var maestro_id = document.getElementById('maestro_id').value;

    $.ajax({
        url: '../add_asignaturas',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            asignatura_id:asignatura_id,
            maestro_id:maestro_id,
            idclase:idclase
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                    $('#clases_asignaturas_table').DataTable().ajax.reload();
            }

            else{
                message_errorU(response.message);
            }
        },
    });

}

function Quitar_asignaturas(id)
{
    $.ajax({
        url: '../del_asignaturas',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                $('#clases_asignaturas_table').DataTable().ajax.reload();
            }

            else{
                message_errorU(response.message);
            }
        },
    });

}

function Table_Alumnos_Gnral()
{
    $('#clases_alumnos_table').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
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
            type:'post',
            url:'../../alumnos_general_index',
            // data:{sucursal_id:sucursal, almacen_id:almacen},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data:'nom_alumno',
                name:'nom_alumno'
            },
            {
                data:'action',
                name:'action'
            },
    ]
    });
}

function Table_Alumnos_Asignados()
{
    var idclase = document.getElementById('idclase').value;
    $('#clases_alumnos_asignados_table').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
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
            type:'post',
            url:'../../alumnos_class_index',
            data:
            {
                idclase:idclase
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data:'nom_alumno',
                name:'nom_alumno'
            },
            {
                data:'action',
                name:'action'
            },
    ]
    });
}

function Agregar_alumnos(id)
{
    var idclase = document.getElementById('idclase').value;
    $.ajax({
        url: '../../add_alumno',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            idalumno:id,
            idclase:idclase
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                $('#clases_alumnos_asignados_table').DataTable().ajax.reload();
                $('#clases_alumnos_table').DataTable().ajax.reload();
            }

            else{
                message_errorU(response.message);
            }
        },
    });
}

function Delete_alumnos(id)
{
    var idclase = document.getElementById('idclase').value;
    $.ajax({
        url: '../../del_alumno',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                $('#clases_alumnos_asignados_table').DataTable().ajax.reload();
                $('#clases_alumnos_table').DataTable().ajax.reload();
            }

            else{
                message_errorU(response.message);
            }
        },
    });
}

$(document).ready(function(){

    $('#form_clase').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../clase',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              console.log(response.message);
              if(response.message == 'ok')
              {
                    message_succesfully_Clase();
                    window.location.href = '../clase';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });

    $('#form_clase_edit').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../../clase_update',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Clase_edit();
                    window.location.href = '../../clase';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });
    Table_Clases();
    Table_Clases_Asignaturas();
    Table_Alumnos_Asignados();
    Table_Alumnos_Gnral();
 

});