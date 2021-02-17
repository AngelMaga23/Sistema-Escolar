<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tarea;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $idclase_a = $id;
        return view('Tareas.index',compact('idclase_a'));
    }

    public function index_tareas_maestro(Request $request)
    {
        if($request->ajax())
        {
            $tareas_asig = DB::table('tareas as t')
                            ->select(DB::raw('t.id,t.nombre,t.descripcion,t.fecha_ini,t.fecha_fin,t.estatu'))
                            ->where('t.idclase_asig',$request->idclase)
                            ->get();

            return datatables()->of($tareas_asig)
                ->addColumn('action','Tareas.Options.options')
                ->addColumn('descripcion','Tareas.Options.descripcion')
                ->rawColumns(['action','descripcion'])
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

        return view('Tareas.create',compact('idclase_a'));
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

            if($request->hasFile('archivo')){

                $file = $request->file('archivo');
                $namefile = time().$file->getClientOriginalName();
                $file->move('Archivos',$namefile);
            }else{
                $namefile = "";
            }

            DB::table('tareas')->insert([

                "nombre"  => $request->nombre,
                "descripcion" => $request->descripcion,
                "archivo" => $namefile,
                "estatu"  => "1",
                "fecha_ini" => $request->fecha_ini,
                "fecha_fin" => $request->fecha_fin,
                "idclase_asig" => $request->idclase,
                "created_at" => date('Y-m-d H:i:s')

            ]);

            return response()->json([
                "message" => "ok",
                "data_id" => $request->idclase
            ],200);
                
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
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
        $tarea = DB::table('tareas')->where('id',$id)->get();

        return view('Tareas.edit',compact('tarea'));
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

            $tarea = DB::table('tareas')->where('id',$request->idtarea)->get();

            if($request->hasFile('archivo')){

                $file = $request->file('archivo');
                $namefile = time().$file->getClientOriginalName();
                $file->move('Archivos',$namefile);
            }else{

                $namefile = $tarea[0]->archivo;
            }

            DB::table('tareas')->where('id',$request->idtarea)->update([

                "nombre"  => $request->nombre,
                "descripcion" => $request->descripcion,
                "archivo" => $namefile,
                "estatu"  => "1",
                "fecha_ini" => $request->fecha_ini,
                "fecha_fin" => $request->fecha_fin,
            ]);

            return response()->json([
                "message" => "ok",
                "data_id" => $request->idclase
            ],200);
                
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
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

            $tarea = Tarea::find($request->id);

            $tarea->delete();

            return response()->json([
                "message" => "ok"
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }
}
