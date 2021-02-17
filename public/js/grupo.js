function Table_Grupos()
{
    $('#grupos_table').DataTable({
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
            url:'grupo_index',
            // data:{sucursal_id:sucursal, almacen_id:almacen},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
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

function Delete_grupo(id)
{
	swal({
		title: "Eliminar grupo",
		text: "¿Estás seguro?",
		icon: "warning",
		buttons: ["Cancelar", "Continuar"],
		dangerMode: true,
		})
		.then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: 'grupo_delete',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "idgrupo":id
                    },

                    success:function(response)
                    {
                        if(response.message == "ok")
                        {
                                message_succesfully_Grupo_delete();
                                $('#grupos_table').DataTable().ajax.reload();
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
    Table_Grupos();


    $('#form_grupo').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../grupo',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Grupo();
                    window.location.href = '../grupo';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });

    $('#form_grupo_edit').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../../grupo_update',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Grupo_update();
                    window.location.href = '../../grupo';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });


});