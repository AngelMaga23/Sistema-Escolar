function Tarea_Options()
{
    var idtarea = document.getElementById('idtarea').value;
    $.ajax({
        url: '../../tarea_options',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":idtarea
        },

        success:function(response)
        {
            $('#id_footer_tarea').html(response);
        },
    });
}

function Delete_entrega(id)
{
	swal({
		title: "Eliminar entrega",
		text: "¿Estás seguro?",
		icon: "warning",
		buttons: ["Cancelar", "Continuar"],
		dangerMode: true,
		})
		.then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '../../del_entrega',
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
                            Tarea_Options();
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

$(document).ready(function () {

    Tarea_Options();




});