<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Foro;
use Illuminate\Support\Facades\Auth;

class ForoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Profesor']);
    }
    public function index($id)
    {
        $idclase_a = $id;
        $iduser = Auth::id();
        $bandera = false;

        $maestro = DB::table('maestros as m')
            ->select(DB::raw('m.iduser'))
            ->join('clase_asignatura as ca', 'ca.idmaestro', '=', 'm.id')
            ->where('ca.id', '=', $idclase_a)
            ->get();

        foreach ($maestro as $m) {
            if ($m->iduser == $iduser) {
                $bandera = true;
                break;
            }
        }

        if($bandera)
        {
            return view('Foro.index', compact('idclase_a'));
        }else{
            abort(403, 'No puedes acceder a estos foros.');
        }
 
    }

    public function index_foros(Request $request)
    {
        if ($request->ajax()) {
            $foros_asign = DB::table('foros as f')
                ->select(DB::raw('f.id,f.nombre,f.descripcion,f.idclase_asig'))
                ->where('f.idclase_asig', $request->idclase)
                ->get();

            return datatables()->of($foros_asign)
                ->addColumn('action', 'Foro.Options.options')
                ->addColumn('descripcion', 'Foro.Options.descripcion')
                ->rawColumns(['action', 'descripcion'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $idclase_a = $id;
        $iduser = Auth::id();
        $bandera = false;

        $maestro = DB::table('maestros as m')
                        ->select(DB::raw('m.iduser'))
                        ->join('clase_asignatura as ca','ca.idmaestro','=','m.id')
                        ->where('ca.id','=',$idclase_a)
                        ->get();

        // dd($maestro);
        foreach ($maestro as $m) {
            if($m->iduser == $iduser)
            {
                $bandera = true;
                break;
            }
        }
        if($bandera){
            return view('Foro.create', compact('idclase_a'));
        }else{
            abort(403, 'No puedes acceder.');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::table('foros')->insert([
                "nombre" => $request->nombre,
                "descripcion" => $request->descripcion,
                "idclase_asig" => $request->idclase,
                "created_at" => date('Y-m-d H:i:s')
            ]);

            return response()->json([
                "message" => "ok",
                "data_id" => $request->idclase
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ], 200);
        }
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
        $foro = Foro::find($id);
        $iduser = Auth::id();
        $bandera = false;

        $maestro = DB::table('maestros as m')
                        ->select(DB::raw('m.iduser'))
                        ->join('clase_asignatura as ca','ca.idmaestro','=','m.id')
                        ->where('ca.id','=',$foro->idclase_asig)
                        ->get();

        // dd($maestro);
        foreach ($maestro as $m) {
            if($m->iduser == $iduser)
            {
                $bandera = true;
                break;
            }
        }
        if($bandera){
            return view('Foro.edit', compact('foro'));
        }else{
            abort(403, 'No puedes acceder.');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            DB::table('foros')->where('id', $request->idforo)->update([
                "nombre" => $request->nombre,
                "descripcion" => $request->descripcion,
            ]);

            return response()->json([
                "message" => "ok",
                "data_id" => $request->idclase
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            $foro = Foro::find($request->id);

            $foro->delete();

            return response()->json([
                "message" => "ok"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ], 200);
        }
    }
}
