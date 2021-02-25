$(document).ready(function(){
    var chatBox = document.querySelector(".chat-box");
    var form = document.querySelector(".typing-area");
    var sendBtn = form.querySelector("button");
    var inputField = form.querySelector(".input-field");
    var inputField = form.querySelector(".input-field");
    var token = $("#token").val();
    var idalumno = $("#outcoming").val();
    
    form.onsubmit = (e)=>{
      e.preventDefault();
    }
    
    inputField.focus();
    inputField.onkeyup = ()=>{
        if(inputField.value != ""){
            sendBtn.classList.add("active");
        }else{
            sendBtn.classList.remove("active");
        }
    }
    sendBtn.onclick = ()=>{
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "../insert_chat_profesor", true);
      xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        }
      }
      let formData = new FormData(form);
      xhr.send(formData);
    }
    chatBox.onmouseenter = ()=>{
      chatBox.classList.add("active");
    }
    
    chatBox.onmouseleave = ()=>{
        chatBox.classList.remove("active");
    }
    
    setInterval(() =>{
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../get-chat_profesor?_token="+token+"&id="+idalumno, true);
        xhr.onload = ()=>{
          if(xhr.readyState === XMLHttpRequest.DONE){
              if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                  }
              }
          }
        }
        xhr.send();
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xhr.send("incoming_id="+incoming_id);
    }, 1000);
    
    function scrollToBottom(){
      chatBox.scrollTop = chatBox.scrollHeight;
    }
    
});