<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatProfesorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Profesor']);
    }
    public function index($id)
    {
        $idclase = $id;
        $iduser = Auth::id();
        $bandera = false;

        $maestro = DB::table('maestros as m')
            ->select(DB::raw('m.iduser'))
            ->join('clase_asignatura as ca', 'ca.idmaestro', '=', 'm.id')
            ->where('ca.idclase', '=', $idclase)
            ->get();

        foreach ($maestro as $m) {
            if ($m->iduser == $iduser) {
                $bandera = true;
                break;
            }
        }

        if($bandera){
            return view('Chat.index', compact('idclase'));
        }else{
            abort(403, 'No puedes acceder a este chat.');
        }

 
    }

    public function Content_Chat(Request $request)
    {
        $id = Auth::id();
        $maestro = DB::table('maestros as m')
            ->select(DB::raw('m.id,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m,u.imagen'))
            ->join('users as u', 'm.iduser', '=', 'u.id')
            ->where('u.id', $id)
            ->get();

        return view('Chat.content_chats', compact('maestro'));
    }

    public function DataAlumnos(Request $request)
    {

        $alumnos_clase = DB::table('alumnos as a')
            ->select(DB::raw('a.id,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m,u.imagen,a.iduser'))
            ->join('alumno_clase as ac', 'ac.idalumno', '=', 'a.id')
            ->join('users as u', 'a.iduser', '=', 'u.id')
            ->where('ac.idclase', $request->get('id'))
            ->get();

        return view('Chat.profesores', compact('alumnos_clase'));
    }

    public function Student_Information(Request $request)
    {
        $idalumno = $request->idalumno;
        $alumno = DB::table('alumnos as a')
            ->select(DB::raw('a.id,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m,u.imagen'))
            ->join('users as u', 'a.iduser', '=', 'u.id')
            ->where('u.id', $idalumno)
            ->get();

        return view('Chat.chat', compact('alumno', 'idalumno'));
    }
    public function GetChat(Request $request)
    {
        $id = Auth::id();
        $maestro = DB::table('maestros')->where('iduser', $id)->get();
        $idout = $request->get('id');
        $mensajes = DB::table('chat as c')
            ->select(DB::raw('c.id,c.incoming_user_id,c.outgoing_user_id,c.mensaje,u.imagen'))
            ->leftJoin('users as u', 'u.id', '=', 'c.outgoing_user_id')
            ->where(function ($query) use ($idout, $id) {
                return $query->where('c.outgoing_user_id', '=', $id)->where('c.incoming_user_id', '=', $idout);
            })->orWhere(function ($query) use ($idout, $id) {
                return $query->where('c.outgoing_user_id', $idout)->where('c.incoming_user_id', $id);
            })->orderBy('c.id')->get();

        // ->where('c.incoming_user_id','=',$request->get('id'))
        // ->where('c.outgoing_user_id','=',$maestro[0]->iduser)

        // ->orWhere('c.outgoing_user_id',$maestro[0]->iduser)

        // ->orWhere('c.incoming_user_id',$request->get('id'))
        // ->orderBy('c.id')
        // ->get();


        return view('Chat.get-chat', compact('mensajes'));
    }

    public function Insert_Chat(Request $request)
    {
        DB::table('chat')->insert([
            "incoming_user_id" => $request->outcoming,
            "outgoing_user_id" => $request->incoming_id,
            "mensaje" => $request->message,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
