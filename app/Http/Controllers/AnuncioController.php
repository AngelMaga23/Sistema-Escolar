<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Publicacion;
use App\Models\Archivo;
use Illuminate\Support\Facades\Auth;

class AnuncioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Profesor']);
    }

    public function index($id)
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
        if($bandera)
        {
            return view('Anuncio.index',compact('idclase_a'));
        }else{
            abort(403, 'No puedes acceder a estas publicaciones.');
        }
        
    }

    public function index_publics_maestro(Request $request)
    {
        if($request->ajax())
        {
            $clase_asigna = DB::table('publicacions as p')
                            ->select(DB::raw('p.id,p.nombre,p.descripcion,tp.nombre as tipo'))
                            ->join('tipo_publicacions as tp','p.idtipo','=','tp.id')
                            ->where('p.idclase_asig',$request->idclase)
                            ->get();

            return datatables()->of($clase_asigna)
                ->addColumn('action','Anuncio.Options.action')
                ->addColumn('descripcion','Anuncio.Options.descripcion')
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
            $tipo = DB::table('tipo_publicacions')->get();

            return view('Anuncio.create',compact('idclase_a','tipo','idclase_a'));
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

        // dd($request->all());
        try {

            DB::table('publicacions')->insert([
                "nombre" => $request->nombre,
                "descripcion" => $request->descripcion,
                "idtipo" => $request->tipo_p,
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
        $publicacion = Publicacion::find($id);
        $tipo = DB::table('tipo_publicacions')->get();
        $iduser = Auth::id();
        $bandera = false;

        $maestro = DB::table('maestros as m')
                        ->select(DB::raw('m.iduser'))
                        ->join('clase_asignatura as ca','ca.idmaestro','=','m.id')
                        ->where('ca.id','=',$publicacion->idclase_asig)
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
            return view('Anuncio.edit',compact('publicacion','tipo'));
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

            $public = DB::table('publicacions')->select(DB::raw('idclase_asig'))->where('id',$request->idpublic)->get();

            DB::table('publicacions')->where('id',$request->idpublic)->update([
                "nombre" => $request->nombre,
                "descripcion" => $request->descripcion,
                "idtipo" => $request->tipo_p,
            ]);

            return response()->json([
                "message" => "ok",
                "data_id" => $public[0]->idclase_asig
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

            $public = Publicacion::find($request->idpublic);

            $public->delete();

            return response()->json([
                "message" => "ok"
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }

    public function index_files_public($id)
    {
        return view('Anuncio.Modal.index',compact('id'));
    }

    public function index_archivos(Request $request)
    {   
        if($request->ajax())
        {

            $archivos = DB::table('archivos')
                        ->where('idpublicacion',$request->id)
                        ->get();

            return datatables()->of($archivos)
                ->addColumn('action','Anuncio.Modal.options')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true); 

        }
    } 

    public function Save_files(Request $request)
    {
        // dd($request->all());
        try {

            if(isset($request->archivos))
            {

                foreach ($request->archivos as $a) {
                    $name_file = time().$a->getClientOriginalName();
                    $a->move('Archivos',$name_file);

                    Archivo::create([
                        'nombre'  => $request->nom_file,
                        'archivo' => $name_file,
                        'idpublicacion' => $request->idpublic,
                    ]);
                }
    
                return response()->json([
                    "message" => "ok"
                ],200);

            }else{

                return response()->json([
                    "message" => "Es necesario seleccionar un archivo"
                ],200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }

    public function destroy_file(Request $request)
    {
        try {

            $file = Archivo::find($request->id);
            if($file->archivo != null){
                $file_path = 'Archivos/'.$file->archivo;
                unlink($file_path);
            }
            $file->delete();

            return response()->json([
                "message" => "ok"
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }

    public function index_coments($id)
    {
        return view('Anuncio.Modal.comentarios',compact('id'));
    }


}
