function Comentarios_publicaciones()
{
    var idpublic = document.getElementById('idpublic').value;
    $.ajax({
        url: '../../coments_publics',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":idpublic
        },

        success:function(response)
        {
            $('#coments_publics').html(response);
        },
    });
}

function Comentar()
{
    var idpublic = document.getElementById('idpublic').value;
    var comentario = document.getElementById('comentario').value;
    $.ajax({
        url: '../../add_coment',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "idpublic":idpublic,
            "comentario":comentario
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                Comentarios_publicaciones();
                $('#comentario').val('');
            }else
            {
                message_errorU(response.message);
            }
        },
    });
}

function Del_Coment(id)
{
	swal({
		title: "Eliminar comentario",
		text: "¿Estás seguro?",
		icon: "warning",
		buttons: ["Cancelar", "Continuar"],
		dangerMode: true,
		})
		.then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '../../del_coment',
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
                            Comentarios_publicaciones();
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

    Comentarios_publicaciones();

});