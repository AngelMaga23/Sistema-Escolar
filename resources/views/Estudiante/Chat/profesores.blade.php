@if (!$profesores_clase->isEmpty())
    @php
        $chat = DB::table('chat')
            ->where('incoming_user_id',$profesores_clase[0]->iduser)
            ->orWhere('outgoing_user_id',$profesores_clase[0]->iduser)
            ->where('outgoing_user_id',Auth::user()->id)
            ->orWhere('incoming_user_id',Auth::user()->id)
            ->orderBy('id','desc')
            ->limit(1)
            ->get();
    @endphp

    @if (!$chat->isEmpty())
        
    @else
    {{-- chat.php?user_id='. $row['unique_id'] .' --}}
        <a href="#">
            <div class="content">
            <img src="{{ asset('images/'.$profesores_clase[0]->imagen) }}" alt="">
            <div class="details">
                <span>{{ $profesores_clase[0]->primer_nom." ".$profesores_clase[0]->segundo_nom." ".$profesores_clase[0]->apellido_p." ".$profesores_clase[0]->apellido_m }}</span>
                <p>No message available</p>
            </div>
            </div>
            {{-- <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div> --}}
        </a>
    @endif


@else
    {{ "No users are available to chat" }}
@endif