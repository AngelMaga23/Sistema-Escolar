@extends('layouts.panel')
<style>
.wrapper{
  background: #fff;
  max-width: 450px;
  width: 100%;
  border-radius: 16px;
  box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
              0 32px 64px -48px rgba(0,0,0,0.5);
}
.users{
  padding: 25px 30px;
}
.users header,
.users-list a{
  display: flex;
  align-items: center;
  padding-bottom: 20px;
  border-bottom: 1px solid #e6e6e6;
  justify-content: space-between;
}
.wrapper img{
  object-fit: cover;
  border-radius: 50%;
}
.users header img{
  height: 50px;
  width: 50px;
}
:is(.users, .users-list) .content{
  display: flex;
  align-items: center;
}
:is(.users, .users-list) .content .details{
  color: #000;
  margin-left: 20px;
}
:is(.users, .users-list) .details span{
  font-size: 18px;
  font-weight: 500;
}
.users header .logout{
  display: block;
  background: #333;
  color: #fff;
  outline: none;
  border: none;
  padding: 7px 15px;
  text-decoration: none;
  border-radius: 5px;
  font-size: 17px;
}
.users .search{
  margin: 20px 0;
  display: flex;
  position: relative;
  align-items: center;
  justify-content: space-between;
}
.users .search .text{
  font-size: 18px;
}
.users .search input{
  position: absolute;
  height: 42px;
  width: calc(100% - 50px);
  font-size: 16px;
  padding: 0 13px;
  border: 1px solid #e6e6e6;
  outline: none;
  border-radius: 5px 0 0 5px;
  opacity: 0;
  pointer-events: none;
  transition: all 0.2s ease;
}
.users .search input.show{
  opacity: 1;
  pointer-events: auto;
}
.users .search button{
  position: relative;
  z-index: 1;
  width: 47px;
  height: 42px;
  font-size: 17px;
  cursor: pointer;
  border: none;
  background: #fff;
  color: #333;
  outline: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.2s ease;
}
.users .search button.active{
  background: #333;
  color: #fff;
}
.search button.active i::before{
  content: '\f00d';
}
.users-list{
  max-height: 350px;
  overflow-y: auto;
}
:is(.users-list, .chat-box)::-webkit-scrollbar{
  width: 0px;
}
.users-list a{
  padding-bottom: 10px;
  margin-bottom: 15px;
  padding-right: 15px;
  border-bottom-color: #f1f1f1;
}
.users-list a:last-child{
  margin-bottom: 0px;
  border-bottom: none;
}
.users-list a img{
  height: 40px;
  width: 40px;
}
.users-list a .details p{
  color: #67676a;
}
.users-list a .status-dot{
  font-size: 12px;
  color: #468669;
  padding-left: 10px;
}
.users-list a .status-dot.offline{
  color: #ccc;
}

</style>
@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Profesores - Chat</h3>
            </div>
            <div class="col text-right">

            </div>
        </div>
    </div>
    <input type="hidden" id="idclase" value="{{ $idclase }}">
    <input type="hidden" id="token" value="{{ csrf_token() }}" name="token">
    <div class="card-body">
        {{-- <div class="table-responsive">
            <!-- Projects table -->
            <table id="profesor_chat_index" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Maestro</th>
                        <th>Asignatura</th>
                        <th>Acción</th>
                    </tr>
                </thead>

            </table>
        </div> --}}

        <div class="wrapper">
            <section class="users">
              <header>
                <div class="content">
       
                    <img src="{{ asset('images/'.$alumno[0]->imagen) }}" alt="Profile">
                  <div class="details">
                    <span>{{ $alumno[0]->primer_nom." ".$alumno[0]->segundo_nom." ".$alumno[0]->apellido_p." ".$alumno[0]->apellido_m }}</span>
              
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
        </div>

</div>
@endsection



@section('custom_script')
    <script src="{{ asset('js/Estudiante/chat_index.js') }}"></script>

@endsection

