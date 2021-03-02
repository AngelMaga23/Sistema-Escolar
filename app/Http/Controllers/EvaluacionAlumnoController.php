<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EvaluacionAlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Alumno']);
    }
    public function index($id)
    {
        $idclase = $id;
        $iduser = Auth::id();
        $bandera = false;

        $alumno = DB::table('alumnos as a')
        ->select(DB::raw('a.iduser'))
        ->join('alumno_clase as ac', 'ac.idalumno', '=', 'a.id')
        ->join('clase_asignatura as ca', 'ca.idclase', '=', 'ac.idclase')
        ->where('ca.id', '=', $idclase)
        ->get();

        foreach ($alumno as $a) {
            if ($a->iduser == $iduser) {
                $bandera = true;
                break;
            }
        }

        if($bandera){
            return view('Estudiante.Evaluacion.index',compact('idclase'));
        }else{
            abort(403, 'No puedes acceder a estas evaluaciones.');
        }

    }

    public function index_evaluacion_clase(Request $request)
    {
        if($request->ajax())
        {
            $eval_clase = DB::table('examens as e')
                ->select(DB::raw('e.id,e.nombre,e.descripcion,e.estatu'))
                ->where('e.idclase_asig',$request->idclase)
                ->get();

            return datatables()->of($eval_clase)
                ->addColumn('action','Estudiante.Evaluacion.Options.action')
                ->addColumn('estatu','Estudiante.Evaluacion.Options.estatu')
                ->rawColumns(['action','estatu'])
                ->addIndexColumn()
                ->make(true);        
                
        }
    }

    public function verEvaluacion($id)
    {
        $iduser = Auth::id();
        $bandera = false;

        $alumno = DB::table('alumnos as a')
            ->select(DB::raw('a.iduser'))
            ->join('alumno_clase as ac', 'ac.idalumno', '=', 'a.id')
            ->join('clase_asignatura as ca', 'ca.idclase', '=', 'ac.idclase')
            ->where('ca.id', '=', $id)
            ->get();

        // dd($alumno);
        foreach ($alumno as $a) {
            if ($a->iduser == $iduser) {
                $bandera = true;
                break;
            }
        }

        if($bandera){
            return view('Estudiante.Evaluacion.verEvaluacion',compact('id'));
        }else{
            abort(403, 'No puedes acceder.');
        }

    }

    public function Description_Test(Request $request)
    {
        $examen = DB::table('examens')->where('id',$request->id)->get();
        $preguntas_count = DB::table('preguntas')->where('idexamen',$request->id)->count();

        return view('Estudiante.Evaluacion.descripcion',compact('examen','preguntas_count'));
    }

    public function Test_Password(Request $request)
    {
        $examen = DB::table('examens')->where('id',$request->id)->get();
        return view('Estudiante.Evaluacion.password',compact('examen'));
    }

    public function Start_Test(Request $request)
    {
        $idexamen = $request->id;
        $password = $request->password;

        $examen = DB::table('examens')->where('id',$idexamen)->where('contrasena',$password)->get();

        if(!$examen->isEmpty())
        {
            $preguntas = DB::table('preguntas')->where('idexamen',$idexamen)->get();

            $id = Auth::id();
            $alumno = DB::table('alumnos')->where('iduser',$id)->get();
            $alumno_clase = DB::table('alumno_clase')->where('idalumno',$alumno[0]->id)->get();
    
            $check_exam_alumno = DB::table('examen_alumno')->where('idexamen',$idexamen)->where('idalumnoclase',$alumno_clase[0]->id)->get();
    
            if($check_exam_alumno->isEmpty())
            {
                $exam_alumno = DB::table('examen_alumno')->insertGetId([
                    "idexamen" => $idexamen,
                    "idalumnoclase" => $alumno_clase[0]->id,
                    "puntos" => 0.00,
                    "restante" => $examen[0]->duracion,
                    "estatu" => '1',
                    "created_at" => date('Y-m-d H:i:s')
                ]);
    
                $alumno_clase = $exam_alumno;
    
            }else{
                $alumno_clase = $check_exam_alumno[0]->id;
            }
    
            return view('Estudiante.Evaluacion.evaluacion',compact('idexamen','examen','preguntas','alumno_clase'));
        }else{
            return response()->json([
                "message" => "no"
            ]);
        }


    }

    public function Continue_Test(Request $request)
    {
        $idexamen = $request->id;

        $examen = DB::table('examens')->where('id',$idexamen)->get();

        $preguntas = DB::table('preguntas')->where('idexamen',$idexamen)->get();

        $id = Auth::id();
        $alumno = DB::table('alumnos')->where('iduser',$id)->get();
        $alumno_clase = DB::table('alumno_clase')->where('idalumno',$alumno[0]->id)->get();

        $check_exam_alumno = DB::table('examen_alumno')->where('idexamen',$idexamen)->where('idalumnoclase',$alumno_clase[0]->id)->get();

        if($check_exam_alumno->isEmpty())
        {
            $exam_alumno = DB::table('examen_alumno')->insertGetId([
                "idexamen" => $idexamen,
                "idalumnoclase" => $alumno_clase[0]->id,
                "puntos" => 0.00,
                "restante" => $examen[0]->duracion,
                "estatu" => '1',
                "created_at" => date('Y-m-d H:i:s')
            ]);

            $alumno_clase = $exam_alumno;

        }else{
            $alumno_clase = $check_exam_alumno[0]->id;
        }

        return view('Estudiante.Evaluacion.evaluacion',compact('idexamen','examen','preguntas','alumno_clase'));


    }

    public function End_Test(Request $request)
    {   
        $idans = array();
        $sum_puntos = 0;
        $id_examen_alumno = $request->alumnoclase;
        $alumno_respuestas = DB::table('alumno_respuesta')->where('idalumnoclase',$request->alumnoclase)->get();

        if(!$alumno_respuestas->isEmpty())
        {
            foreach ($alumno_respuestas as $ar) {
            
                $respuesta = DB::table('respuestas')->where('id',$ar->idrespuesta)->get();
    
                if($respuesta[0]->estatu)
                {
                    $pregunta = DB::table('preguntas')->where('id',$respuesta[0]->idpregunta)->get();
                    $sum_puntos = $sum_puntos + $pregunta[0]->valor;
                }
    
            }
        }

        $exam_alumno = DB::table('examen_alumno')->where('id',$request->alumnoclase)->get();

        DB::table('examen_alumno')->where('id',$request->alumnoclase)->update([
            "restante" => $exam_alumno[0]->restante,
            "estatu"   => '0',
            "puntos"   => $sum_puntos
        ]);

        return view('Estudiante.Evaluacion.result',compact('id_examen_alumno'));


    }

    public function Update_Time_Test(Request $request)
    {
        DB::table('examen_alumno')->where('id',$request->id)->update([
            "restante" => $request->time
        ]);
    }

    public function Select_Answer(Request $request)
    {
        DB::table('alumno_respuesta')
            ->updateOrInsert(
                ['idalumnoclase' => $request->id, 'idpregunta' => $request->idpregunta],
                ['idrespuesta' => $request->idrespuesta]
            );
    }

    public function Resultado($id)
    {
        $id_examen_alumno = $id;
        return view('Estudiante.Evaluacion.result',compact('id_examen_alumno'));
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
