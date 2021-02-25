<section class="chat-area">
    <header>

      <a onclick="Content_Chats()" class="back-icon" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></a>
      <img src="{{ asset('images/'.$alumno[0]->imagen) }}" alt="">
      <div class="details">
        <span>{{  $alumno[0]->primer_nom." ".$alumno[0]->segundo_nom." ".$alumno[0]->apellido_p." ".$alumno[0]->apellido_m  }}</span>
        {{-- <p><?php echo $row['status']; ?></p> --}}
      </div>
    </header>
    <div class="chat-box">

    </div>
    <form action="#" class="typing-area">
      <input type="text" class="incoming_id" name="incoming_id" value="{{ $alumno[0]->id }}" hidden>
      <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
      <button><i class="fab fa-telegram-plane"></i></button>
    </div>
</section>