<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\Maestro;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $iduser = Auth::id();
        $user = User::find($iduser);

        if($user->hasRole('Administrador'))
        {
            $usuario = DB::table('users')->where('id',$iduser)->get();

            return view('Perfil.index',compact('usuario'));

        }elseif($user->hasRole('Profesor')){

            $usuario = DB::table('users')->where('id',$iduser)->get();
            $detalle = DB::table('maestros')->where('iduser',$iduser)->get();
            $idcuenta = $detalle[0]->id;

            return view('Perfil.index',compact('usuario','detalle','idcuenta'));
        }elseif($user->hasRole('Alumno')){

            $usuario = DB::table('users')->where('id',$iduser)->get();
            $detalle = DB::table('alumnos')->where('iduser',$iduser)->get();
            $idcuenta = $detalle[0]->id;

            return view('Perfil.index',compact('usuario','detalle','idcuenta'));
        }

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
    public function update(Request $request)
    {
        try {

            $user = User::find($request->idusuario);

            if($request->hasFile('foto')){

                $file = $request->file('foto');
                $nameimg = time().$file->getClientOriginalName();
                $file->move('images',$nameimg);
                if($user->imagen != null)
                {
                    $image_path = 'images/'.$user->imagen;
                    unlink($image_path);
                }
            }else{
                $nameimg = $user->imagen;
            }

            if($request->n_contrasena != null)
            {
                $pass = Hash::make($request->n_contrasena);
            }else{
                $pass = $user->password;
            }


            $user->name = $request->input('nom_user');
            $user->email = $request->input('email');
            $user->imagen = $nameimg;
            $user->password = $pass;
            $user->save();

            if($user->hasRole('Administrador'))
            {
                return response()->json([
                    "message" => "ok",
                    "id" => $request->idusuario
                ],200);

            }elseif($user->hasRole('Profesor'))
            {
                $maestro = Maestro::find($request->idcuenta);

                $maestro->primer_nom = $request->input('p_nombre');
                $maestro->segundo_nom = $request->input('s_nombre');
                $maestro->apellido_p = $request->input('a_paterno');
                $maestro->apellido_m = $request->input('a_materno');
                $maestro->direccion = $request->input('direccion');
                $maestro->telefono = $request->input('telefono');
    
                $maestro->save();
    
                return response()->json([
                    "message" => "ok",
                    "id" => $request->idusuario
                ],200);

            }elseif($user->hasRole('Alumno')){
                $alumno = Alumno::find($request->idcuenta);

                $alumno->primer_nom = $request->input('p_nombre');
                $alumno->segundo_nom = $request->input('s_nombre');
                $alumno->apellido_p = $request->input('a_paterno');
                $alumno->apellido_m = $request->input('a_materno');
                $alumno->direccion = $request->input('direccion');
                $alumno->telefono = $request->input('telefono');
       
    
                $alumno->save();
    
                return response()->json([
                    "message" => "ok",
                    "id" => $request->idusuario
                ],200);
            }



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
    public function destroy($id)
    {
        //
    }
}
