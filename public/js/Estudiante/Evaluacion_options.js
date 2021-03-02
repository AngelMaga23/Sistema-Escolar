function Description_test()
{
    var idexamen = document.getElementById('idexamen').value;
    $.ajax({
        url: '../../description_test',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":idexamen
        },

        success:function(response)
        {
            $('#id_content_evaluacion').html(response);
        },
    });
}

function Password_Test()
{
    var idexamen = document.getElementById('idexamen').value;
    $.ajax({
        url: '../../pass_test',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":idexamen
        },

        success:function(response)
        {
            $('#id_content_evaluacion').html(response);
        },
    });
}

function start_test()
{
    var idexamen = document.getElementById('idexamen').value;
    var password = document.getElementById('pass_test').value;
    $.ajax({
        url: '../../start_test',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":idexamen,
            "password":password
        },

        success:function(response)
        {
            if(response.message == 'no')
            {
                message_errorU("Contraseña incorrecta");
            }else{
                $('#id_content_evaluacion').html(response);
            }
            
        },
    });
}

function continue_test()
{
    var idexamen = document.getElementById('idexamen').value;

    $.ajax({
        url: '../../continue_test',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":idexamen,
        },

        success:function(response)
        {
            $('#id_content_evaluacion').html(response);
        },
    });
}

$(document).ready(function () {
    Description_test();



});