        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
              <div class="sidebar-brand-icon rotate-n-15" style="transform: rotate(0deg) !important;">
                  <img src="{{ asset('img/logo_escuela.png') }}" style="width:60px;height:60px" alt="Logo escolar">
                  {{-- <i class="fas fa-laugh-wink"></i> --}}
              </div>
              <div class="sidebar-brand-text mx-3">Sistema escolar <sup></sup></div>
          </a>

          <!-- Divider -->
          <hr class="sidebar-divider my-0">

          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
              <a class="nav-link" href="{{ url('/') }}">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
          </li>

          <!-- Divider -->
          {{-- <hr class="sidebar-divider"> --}}

          <!-- Heading -->
          {{-- <div class="sidebar-heading">
              Interface
          </div> --}}

          <!-- Nav Item - Pages Collapse Menu -->
          {{-- <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                  aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Components</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Custom Components:</h6>
                      <a class="collapse-item" href="buttons.html">Buttons</a>
                      <a class="collapse-item" href="cards.html">Cards</a>
                  </div>
              </div>
          </li> --}}

          <!-- Nav Item - Utilities Collapse Menu -->
          {{-- <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                  aria-expanded="true" aria-controls="collapseUtilities">
                  <i class="fas fa-fw fa-wrench"></i>
                  <span>Utilities</span>
              </a>
              <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Custom Utilities:</h6>
                      <a class="collapse-item" href="utilities-color.html">Colors</a>
                      <a class="collapse-item" href="utilities-border.html">Borders</a>
                      <a class="collapse-item" href="utilities-animation.html">Animations</a>
                      <a class="collapse-item" href="utilities-other.html">Other</a>
                  </div>
              </div>
          </li> --}}

          <!-- Divider -->
          <hr class="sidebar-divider">


          <!-- Nav Item - Charts -->
            @if (Auth::user()->hasRole('Administrador'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('alumno') }}">
                        <i class="fas fa-user-graduate text-blue"></i>
                        <span>Alumnos</span></a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('maestro') }}">
                        <i class="fas fa-chalkboard-teacher text-red"></i>
                        <span>Maestros</span></a>
                </li>    
    


                <li class="nav-item">
                    <a class="nav-link" href="{{ url('grupo') }}">
                        <i class="fas fa-users text-info"></i>
                        <span>Grupos</span></a>
                </li>



                <li class="nav-item">
                    <a class="nav-link" href="{{ url('asignatura') }}">
                        <i class="fas fa-book text-danger"></i>
                        <span>Asignaturas</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('clase') }}">
                        <i class="fas fa-chalkboard text-orange"></i>
                        <span>Clases</span></a>
                </li>             
            @endif
            
            @if (Auth::user()->hasRole('Profesor'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('alumno') }}">
                        <i class="fas fa-user-graduate text-blue"></i>
                        <span>Alumnos</span></a>
                </li> 
                @php
                    $maestro = DB::table('maestros')->where('iduser',Auth::user()->id)->get();
                    $clase_asignaturas = DB::table('clase_asignatura as ca')
                                        ->select(DB::raw('ca.id,a.nombre as asignatura'))
                                        ->join('asignaturas as a','ca.idasignatura','=','a.id')
                                        ->join('clases as c','ca.idclase','=','c.id')
                                        ->join('maestros as m','ca.idmaestro','=','m.id')
                                        ->get();
                @endphp

                @foreach ($clase_asignaturas as $ca)
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="{{ "#".$ca->asignatura.$ca->id }}"
                            aria-expanded="true" aria-controls="{{ $ca->asignatura.$ca->id }}">
                            <i class="fas fa-book"></i>
                            <span>{{ $ca->asignatura }} </span>
                        </a>
                        <div id="{{ $ca->asignatura.$ca->id }}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Opciones:</h6>
                                <a class="collapse-item" href="{{ url('publicacion/'.$ca->id) }}">Publicaciones</a>
                                <a class="collapse-item" href="{{ url('tarea/'.$ca->id) }}">Tareas</a>
                                <a class="collapse-item" href="{{ url('foro/'.$ca->id) }}">Foros</a>
                                <a class="collapse-item" href="{{ url('evaluacion/'.$ca->id) }}">Evaluaciones</a>
                            </div>
                        </div>
                    </li>                                            
                @endforeach
              
            @endif

            @if (Auth::user()->hasRole('Alumno'))
                
                    @php
                        $alumno = DB::table('alumnos')->where('iduser',Auth::user()->id)->get();

                        $alumno_clase = DB::table('alumno_clase')->where('idalumno',$alumno[0]->id)->get();

                        $clase_asignaturas = DB::table('clase_asignatura as ca')
                                        ->select(DB::raw('ca.id,a.nombre as asignatura, c.id as idclase'))
                                        ->join('asignaturas as a','ca.idasignatura','=','a.id')
                                        ->join('clases as c','ca.idclase','=','c.id')
                                        ->where('ca.idclase',$alumno_clase[0]->idclase)
                                        ->get();
                    @endphp

                    @foreach ($clase_asignaturas as $ca)
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="{{ "#".$ca->asignatura.$ca->id }}"
                                aria-expanded="true" aria-controls="{{ $ca->asignatura.$ca->id }}">
                                <i class="fas fa-book"></i>
                                <span>{{ $ca->asignatura }} </span>
                            </a>
                            <div id="{{ $ca->asignatura.$ca->id }}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Opciones:</h6>
                                    <a class="collapse-item" href="{{ url('alumno-publicacion/'.$ca->id) }}">Publicaciones</a>
                                    <a class="collapse-item" href="{{ url('alumno-tarea/'.$ca->id) }}">Tareas</a>
                                    <a class="collapse-item" href="{{ url('alumno-evaluacion/'.$ca->id) }}">Evaluaciones</a>
                                    {{-- <a class="collapse-item" href="{{  }}">Profesor</a> --}}
          
                                </div>
                            </div>
                        </li>                                         
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('alumno-chat/'.$alumno_clase[0]->idclase) }}">
                            <i class="fas fa-chalkboard-teacher text-red"></i>
                            <span>Chat</span></a>
                    </li>       
            @endif



          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">

          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
              <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>

          <!-- Sidebar Message -->
          {{-- <div class="sidebar-card">
              <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="">
              <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
              <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
          </div> --}}

      </ul>
      <!-- End of Sidebar -->