function Table_Alumnos()
{
    $('#alumnos_table').DataTable({
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
            url:'alumno_index',
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
                    url: 'alumno_delete',
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
                                $('#alumnos_table').DataTable().ajax.reload();
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

$(document).ready(function(){
    Table_Alumnos();


    $('#form_alumnos').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../alumno',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Alumno();
                    window.location.href = '../alumno';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });


    $('#form_alumnos_edit').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../../alumno_update',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Alumno_update();
                    window.location.href = '../../alumno';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });

});