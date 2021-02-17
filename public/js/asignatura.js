function Table_Asignaturas()
{
    $('#asignaturas_table').DataTable({
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
            url:'asignatura_index',
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
                data:'descripcion',
                name:'descripcion'
            },
            {
                data:'action',
                name:'action'
            },
    ]
    });
}

function Delete_asignatura(id)
{
	swal({
		title: "Eliminar asignatura",
		text: "¿Estás seguro?",
		icon: "warning",
		buttons: ["Cancelar", "Continuar"],
		dangerMode: true,
		})
		.then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: 'asignatura_delete',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "idasign":id
                    },

                    success:function(response)
                    {
                        if(response.message == "ok")
                        {
                                message_succesfully_Asignatura_delete();
                                $('#asignaturas_table').DataTable().ajax.reload();
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
    Table_Asignaturas();


    $('#form_asignatura').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../asignatura',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Asignatura();
                    window.location.href = '../asignatura';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });

    $('#form_asignatura_edit').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:'../../asignatura_update',
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,			
          success:function(response)
          {
              if(response.message == 'ok')
              {
                    message_succesfully_Asignatura_update();
                    window.location.href = '../../asignatura';

              }
              else{
                message_errorU(response.message);
              }
          }
        });
    });


});