@if (!$mensajes->isEmpty())
    @foreach ($mensajes as $m)
        @if ($m->outgoing_user_id == Auth::user()->id)
            <div class="chat outgoing">
                <div class="details">
                    <p>{{ $m->mensaje }}</p>
                </div>
            </div>
        @else
            <div class="chat incoming">
                <img src="{{ asset('images/'.$m->imagen) }}" alt="">
                <div class="details">
                    <p>{{ $m->mensaje }}</p>
                </div>
            </div>
        @endif
    @endforeach
@else
    <div class="text">No hay mensajes disponibles. Una vez que envíe el mensaje, aparecerán aquí..</div>
@endif