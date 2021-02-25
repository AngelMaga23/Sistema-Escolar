<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $idclase = $id;


        return view('Estudiante.Chat.index', compact('idclase'));
    }

    public function Content_Chat(Request $request)
    {
        $id = Auth::id();
        $alumno = DB::table('alumnos as a')
                    ->select(DB::raw('a.id,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m,u.imagen'))
                    ->join('users as u','a.iduser','=','u.id')
                    ->where('u.id',$id)
                    ->get();

        return view('Estudiante.Chat.content_chats', compact('alumno'));
    }

    public function ChatProfesorIndex(Request $request)
    {
        if ($request->ajax()) {

            $profesores_clase = DB::table('maestros as m')
                ->select(DB::raw('m.id,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m,a.nombre,u.imagen'))
                ->join('clase_asignatura as ca', 'ca.idmaestro', '=', 'm.id')
                ->join('asignaturas as a', 'ca.idasignatura', '=', 'a.id')
                ->join('users as u','m.iduser','=','u.id')
                ->get();

            return view('Estudiante.Chat.index',compact('profesores_clase'));
            // return datatables()->of($profesores_clase)
            //     ->addColumn('action', 'Estudiante.Chat.Options.options')
            //     ->addColumn('maestro', 'Estudiante.Chat.Options.maestro')
            //     ->rawColumns(['action', 'maestro'])
            //     ->addIndexColumn()
            //     ->make(true);
        }
    }

    public function Dataprofesores(Request $request)
    {

        $profesores_clase = DB::table('maestros as m')
            ->select(DB::raw('m.id,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m,a.nombre,u.imagen,m.iduser'))
            ->join('clase_asignatura as ca', 'ca.idmaestro', '=', 'm.id')
            ->join('asignaturas as a', 'ca.idasignatura', '=', 'a.id')
            ->join('users as u','m.iduser','=','u.id')
            ->where('ca.id',$request->get('id'))
            ->get();

        return view('Estudiante.Chat.profesores', compact('profesores_clase'));
    }

    public function Student_Information(Request $request)
    {
        $id = Auth::id();
        $alumno = DB::table('alumnos as a')
                    ->select(DB::raw('a.id,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m,u.imagen'))
                    ->join('users as u','a.iduser','=','u.id')
                    ->where('u.id',$id)
                    ->get();

        return view('Estudiante.Chat.chat', compact('alumno'));
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
