function Table_Preguntas()
{
    var idexamen = document.getElementById('idexamen').value;
    $('#evaluacion_questions_table').DataTable({
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
            url:'../../../preguntas_index',
            data:{id:idexamen},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data:'pregunta',
                name:'pregunta'
            },
            {
                data:'valor',
                name:'valor'
            },
            {
                data:'action',
                name:'action'
            },
    ]
    });
}

function Add_Questions()
{

    var idexamen = document.getElementById('idexamen').value;
    var pregunta = document.getElementById('question').value;
    var valor = document.getElementById('question_valor').value;

    $.ajax({
        url: '../../add_question',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            idexamen:idexamen,
            pregunta:pregunta,
            valor:valor,
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                $('#evaluacion_questions_table').DataTable().ajax.reload();
                $('#question').val('');
                $('#question_valor').val('');
                Get_Suma_Valor();
            }

            else{
                message_errorU(response.message);
            }
        },
    });
}

function Delete_Question(id)
{
	swal({
		title: "Eliminar pregunta",
		text: "¿Estás seguro?",
		icon: "warning",
		buttons: ["Cancelar", "Continuar"],
		dangerMode: true,
		})
		.then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '../../del_question',
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
                                $('#evaluacion_questions_table').DataTable().ajax.reload();
                                Get_Suma_Valor();
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

function Get_Suma_Valor()
{
    var idexamen = document.getElementById('idexamen').value;
    $.ajax({
        url: '../../get_suma_valor',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:idexamen,
        },

        success:function(response)
        {
            console.log(response);
            $('#puntos_total').html(response.total_valor);
        },
    });
}

function Table_Respuestas()
{
    var idpregunta = document.getElementById('pregunta_id').value;
    $('#evaluacion_answers_table').DataTable({
        paging: false,
        lengthChange: false,
        searching: false,
        ordering: false,
        info: false,
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
            type:'post',
            url:'../../../respuestas_index',
            data:{id:idpregunta},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data:'respuesta',
                name:'respuesta'
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


function Respuestas(dato)
{
  var options = {
    modal: true,
    height:300,
    width:600
  };

    $('#content_respuesta').html('<div class="preloader"><img src="images/91.gif" alt="loading" width="50" height="50" /><br/></div>');
    $('#content_respuesta').load('../../pregunta/'+dato, function() {
        $('#pregunta_respuesta').modal({show:true});
        Table_Respuestas();
    });
}

function Add_Answers()
{
    var res = document.getElementById('respuesta_').value;
    var est = document.getElementById('estatu_respuesta').value;
    var idp = document.getElementById('pregunta_id').value;

    $.ajax({
        url: '../../add_answers',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            res:res,
            est:est,
            idp:idp,
        },

        success:function(response)
        {
            if(response.message == "ok")
            {
                $('#evaluacion_answers_table').DataTable().ajax.reload();
            }else{
                message_errorU(response.message);
            }
        },
    });
}

function Delete_Answer(id)
{
	swal({
		title: "Eliminar respuesta",
		text: "¿Estás seguro?",
		icon: "warning",
		buttons: ["Cancelar", "Continuar"],
		dangerMode: true,
		})
		.then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '../../del_answers',
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
                                $('#evaluacion_answers_table').DataTable().ajax.reload();
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
    Table_Preguntas();
    Get_Suma_Valor();
});