<section class="users">
    <header>
      <div class="content">

          <img src="{{ asset('images/'.$maestro[0]->imagen) }}" alt="Profile">
        <div class="details">
          <span>{{ $maestro[0]->primer_nom." ".$maestro[0]->segundo_nom." ".$maestro[0]->apellido_p." ".$maestro[0]->apellido_m }}</span>
    
        </div>
      </div>
      {{-- <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a> --}}
    </header>
    {{-- <div class="search">
      <span class="text">Select an user to start chat</span>
      <input type="text" placeholder="Enter name to search...">
      <button><i class="fas fa-search"></i></button>
    </div> --}}
    <div class="users-list">

    </div>
</section>

<script>
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
    }, 3000);
</script>