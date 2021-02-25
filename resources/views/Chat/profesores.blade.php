@if (!$alumnos_clase->isEmpty())

    @foreach ($alumnos_clase as $p)
        @php
            $id =Auth::user()->id;
            $idout = $p->iduser;
            $chat = DB::table('chat as c')
                        ->where(function ($query) use ($idout,$id){
                            return $query->where('c.outgoing_user_id','=',$id)->where('c.incoming_user_id','=',$idout);
                        })->orWhere(function ($query) use ($idout,$id){
                            return $query->where('c.outgoing_user_id',$idout)->where('c.incoming_user_id',$id);
                        })
                    ->orderBy('c.id','desc')
                    ->limit(1)
                    ->get();
        @endphp
        @if (!$chat->isEmpty())
            <a onclick="Chat({{ $p->iduser }})" style="cursor: pointer;">
                <div class="content">
                <img src="{{ asset('images/'.$p->imagen) }}" alt="">
                <div class="details">
                    <span>{{ $p->primer_nom." ".$p->segundo_nom." ".$p->apellido_p." ".$p->apellido_m }}</span>
                    <p>{{ $chat[0]->mensaje }}</p>
                </div>
                </div>
                {{-- <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div> --}}
            </a>
        @else
            <a onclick="Chat({{ $p->iduser }})" style="cursor: pointer;">
                <div class="content">
                <img src="{{ asset('images/'.$p->imagen) }}" alt="">
                <div class="details">
                    <span>{{ $p->primer_nom." ".$p->segundo_nom." ".$p->apellido_p." ".$p->apellido_m }}</span>
                    <p>No hay mensajes disponibles</p>
                </div>
                </div>
                {{-- <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div> --}}
            </a>

        @endif

    @endforeach



@else
    {{ "No users are available to chat" }}
@endif