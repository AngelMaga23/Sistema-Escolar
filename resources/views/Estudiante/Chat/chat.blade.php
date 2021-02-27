<section class="chat-area">
    <header>

      <a onclick="Content_Chats()" class="back-icon" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></a>
      <img src="{{ asset('images/'.$profesor[0]->imagen) }}" alt="">
      <div class="details">
        <span>{{  $profesor[0]->primer_nom." ".$profesor[0]->segundo_nom." ".$profesor[0]->apellido_p." ".$profesor[0]->apellido_m  }}</span>
        {{-- <p><?php echo $row['status']; ?></p> --}}
      </div>
    </header>
    <div class="chat-box">

    </div>
    <form action="#" class="typing-area">
      @csrf
      <input type="text" class="incoming_id" name="incoming_id" value="{{ Auth::user()->id }}" hidden>
      <input type="hidden" id="outcoming" name="outcoming" value="{{ $idprofesor }}">
      <input type="text" name="message" class="input-field" placeholder="Escriba un mensaje aquí..." autocomplete="off">
      <button><i class="fab fa-telegram-plane"></i></button>
    </div>
</section>

<script>
  var chatBox = document.querySelector(".chat-box");
  var form = document.querySelector(".typing-area");
  var sendBtn = form.querySelector("button");
  var inputField = form.querySelector(".input-field");
  var inputField = form.querySelector(".input-field");
  var token = $("#token").val();
  var idprofesor = $("#outcoming").val();

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
    xhr.open("POST", "../insert_chat", true);
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
      xhr.open("GET", "../get-chat?_token="+token+"&id="+idprofesor, true);
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
  }, 4000);

  function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }

</script>