function Table_Maestros()
{
    $('#maestros_table').DataTable({
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
            url:'maestro_index',
            // data:{sucursal_id:sucursal, almacen_id:almacen},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data:'Foto_perfil',
                name:'Foto_perfil'
            },
            {
                data:'email',
                name:'email'
            },
            {
                data:'Nombre_completo',
                name:'Nombre_completo'
            },
            {
                data:'direccion',
                name:'direccion'
            },
            {
                data:'telefono',
                name:'telefono'
            },
            {
                data:'estatu',
                name:'estatu'
            },
            {
                data:'action',
                name:'action'
            },
    ]
    });
}



function Estatu_usuario(id)
{
	swal({
		title: "Cambiar estatu del Usuario",
		text: "¿Estás seguro?",
		icon: "warning",
		buttons: ["Cancelar", "Continuar"],
		dangerMode: true,
		})
		.then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: 'maestro_delete',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "iduser":id
                    },

                    success:function(response)
                    {
                        if(response.message == "ok")
                        {
                                message_succesfullyDel_user();
                                $('#maestros_table').DataTable().ajax.reload();
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

function Asignaturas(dato)
{
  var options = {
    modal: true,
    height:300,
    width:600
  };

    $('#content_asignaturas').html('<div class="preloader"><img src="images/91.gif" alt="loading" width="50" height="50" /><br/></div>');
    $('#content_asignaturas').load('maestro_asignaturas/'+dato, function() {
        $('#maestro_asignatura').modal({show:true});
        Table_Asignaturas();
    });
}

function select_asignatura(id)
{

    var idmaestro = document.getElementById('idmaestro').value;
    console.log(idmaestro);
    $.ajax({
        url: '../../select_asignatura',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "idasignatura":id,
            "idmaestro":idmaestro
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                    $('#asignadas_table').DataTable().ajax.reload();
                    $('#asignaturas_table').DataTable().ajax.reload();
            }

            else{
                message_errorU(response.message);
            }
        },
    });
}

function Quitar_asignatura(id)
{
    $.ajax({
        url: '../../quitar_asignatura',
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
                    $('#asignadas_table').DataTable().ajax.reload();
                    $('#asignaturas_table').DataTable().ajax.reload();
            }

            else{
                message_errorU(response.message);
            }
        },
    });
}

$(document).ready(function(){
    Table_Maestros();

    $('#form_maestros').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../maestro',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Maestro();
                    window.location.href = '../maestro';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });


    $('#form_maestros_edit').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../../maestro_update',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Maestro_update();
                    window.location.href = '../../maestro';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });


});