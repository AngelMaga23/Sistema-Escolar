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
                            ->select(DB::raw('e.id,e.nombre,e.descripcion,e.fecha_ini,e.fecha_fin,e.estatu,e.idclase_asig,e.duracion'))
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
                "duracion"  => $request->duracion,
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
                "duracion"  => $request->duracion,
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

    public function Question($id)
    {

        $evaluacion = DB::table('examens')->where('id',$id)->get();

        return view('Evaluacion.question',compact('evaluacion'));
    }

    public function index_questions(Request $request)
    {
        if($request->ajax())
        {
            $preguntas = DB::table('preguntas')->where('idexamen',$request->id)->get();

            return datatables()->of($preguntas)
                ->addColumn('action','Evaluacion.Preguntas.Options.options')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true); 
        }

    }

    public function Add_Question(Request $request)
    {
        try {
            DB::table('preguntas')->insert([
                "pregunta" => $request->pregunta,
                "valor" => $request->valor,
                "idexamen" => $request->idexamen,
            ]);

            return response()->json([
                "message" => "ok"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }

    public function Del_Question(Request $request)
    {   
        try {
            DB::table('preguntas')->where('id',$request->id)->delete();
            return response()->json([
                "message" => "ok"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }

    public function Suma_valor(Request $request)
    {
        $preguntas = DB::table('preguntas')->where('idexamen',$request->id)->get();
        $suma = 0;

        if(!$preguntas->isEmpty())
        {
            foreach ($preguntas as $p) {
                $suma += $p->valor;
            }

            return response()->json([
                "total_valor" => $suma
            ]);
        }else{
            return response()->json([
                "total_valor" => $suma
            ]);
        }
    }

    public function Respuestas($id)
    {
        $pregunta = DB::table('preguntas')->where('id',$id)->get();
        return view('Evaluacion.Preguntas.index',compact('pregunta'));
    }

    public function index_respuestas(Request $request)
    {
        if($request->ajax())
        {
            $respuestas = DB::table('respuestas')->where('idpregunta',$request->id)->get();

            return datatables()->of($respuestas)
                ->addColumn('action','Evaluacion.Preguntas.Respuestas.options')
                ->addColumn('estatu','Evaluacion.Preguntas.Respuestas.estatu')
                ->rawColumns(['action','estatu'])
                ->addIndexColumn()
                ->make(true); 
        }

    }

    public function Add_Answers(Request $request)
    {
        try {
            
            DB::table('respuestas')->insert([
                "respuesta" => $request->res,
                "estatu" => $request->est,
                "idpregunta" => $request->idp,
            ]);

            return response()->json([
                "message" => "ok"
            ]);



        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }

    public function Del_Answers(Request $request)
    {   
        try {
            DB::table('respuestas')->where('id',$request->id)->delete();
            return response()->json([
                "message" => "ok"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }

}
