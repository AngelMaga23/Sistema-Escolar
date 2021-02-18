<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Examen;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $idclase_a = $id;
        return view('Evaluacion.index',compact('idclase_a'));
    }

    public function index_evaluacion(Request $request)
    {
        if($request->ajax())
        {
            $eval_asign = DB::table('examens as e')
                            ->select(DB::raw('e.id,e.nombre,e.descripcion,e.fecha_ini,e.fecha_fin,e.estatu,e.idclase_asig'))
                            ->where('e.idclase_asig',$request->idclase)
                            ->get();

            return datatables()->of($eval_asign)
                ->addColumn('action','Evaluacion.Options.options')
                ->addColumn('descripcion','Evaluacion.Options.descripcion')
                ->addColumn('estatu','Evaluacion.Options.estatu')
                ->rawColumns(['action','descripcion','estatu'])
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

        return view('Evaluacion.create',compact('idclase_a'));
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

            DB::table('examens')->insert([

                "nombre"  => $request->nombre_eval,
                "descripcion" => $request->descripcion,
                "estatu"  => $request->estatu_eval,
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
        $evaluacion = DB::table('examens')->where('id',$id)->get();

        return view('Evaluacion.edit',compact('evaluacion'));
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


            DB::table('examens')->where('id',$request->ideval)->update([

                "nombre"  => $request->nombre_eval,
                "descripcion" => $request->descripcion,
                "estatu"  => $request->estatu_eval,
                "fecha_ini" => $request->fecha_ini,
                "fecha_fin" => $request->fecha_fin,
                "idclase_asig" => $request->idclase,

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

            $examen = Examen::find($request->id);

            $examen->delete();

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
