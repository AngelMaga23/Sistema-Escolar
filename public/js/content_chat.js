$(document).ready(function(){
    var usersList = document.querySelector(".users-list");
    setInterval(() =>{
        var id = document.getElementById('idclase').value;
        var token = $("#token").val();
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../data-alumnos?_token="+token+"&id="+id, true);
        xhr.onload = ()=>{
          if(xhr.readyState === XMLHttpRequest.DONE){
              if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
              }
          }
        }
        xhr.send();
    }, 1000);
});