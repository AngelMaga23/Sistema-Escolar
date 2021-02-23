<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\PublicacionAlumnoController;
use App\Http\Controllers\TareaAlumnoController;
use App\Http\Controllers\EvaluacionAlumnoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Alumnos */
Route::resource('alumno',AlumnoController::class);
Route::post('alumno_index', [AlumnoController::class, 'index']);
Route::post('alumno_update', [AlumnoController::class, 'update']);
Route::post('alumno_delete', [AlumnoController::class, 'destroy']);

/* Maestros */
Route::resource('maestro',MaestroController::class);
Route::post('maestro_index', [MaestroController::class, 'index']);
Route::post('maestro_update', [MaestroController::class, 'update']);
Route::post('maestro_delete', [MaestroController::class, 'destroy']);
Route::get('maestro_asignaturas/{id}', [MaestroController::class, 'Asignaturas']);
Route::post('maestro_asig_index', [MaestroController::class, 'table_asignaturas']);
Route::post('maestro_asignadas_index', [MaestroController::class, 'asignaturas_establecidas']);
Route::post('select_asignatura', [MaestroController::class, 'seleccionar_asignatura']);
Route::post('quitar_asignatura', [MaestroController::class, 'quitar_asignatura']);

Route::get('create-roles', [MaestroController::class, 'create_roles']);

/* Grupos */
Route::resource('grupo',GrupoController::class);
Route::post('grupo_index', [GrupoController::class, 'index']);
Route::post('grupo_update', [GrupoController::class, 'update']);
Route::post('grupo_delete', [GrupoController::class, 'destroy']);

/* Asignatura */
Route::resource('asignatura',AsignaturaController::class);
Route::post('asignatura_index', [AsignaturaController::class, 'index']);
Route::post('asignatura_update', [AsignaturaController::class, 'update']);
Route::post('asignatura_delete', [AsignaturaController::class, 'destroy']);

/* Clase */
Route::resource('clase',ClaseController::class);
Route::post('clase_index', [ClaseController::class, 'index']);
Route::post('clase_update', [ClaseController::class, 'update']);
Route::post('clase_delete', [ClaseController::class, 'destroy']);
Route::get('clase-asignaturas/{id}', [ClaseController::class, 'clase_asignaturas']);
Route::post('clase_asignaturas_index', [ClaseController::class, 'index_class_sub']);
Route::post('add_asignaturas', [ClaseController::class, 'Agregar_asignaturas']);
Route::post('del_asignaturas', [ClaseController::class, 'Quitar_asignaturas']);
Route::get('clase-alumnos/{id}', [ClaseController::class, 'clase_alumnos']);

Route::post('alumnos_general_index', [ClaseController::class, 'alumnos_general']);
Route::post('alumnos_class_index', [ClaseController::class, 'alumnos_clase_asig_index']);

Route::post('add_alumno', [ClaseController::class, 'Add_alumnos']);
Route::post('del_alumno', [ClaseController::class, 'Del_alumnos']);

/** Perfil */
Route::get('perfil/{id}',[PerfilController::class, 'index']);
Route::post('perfil_update', [PerfilController::class, 'update']);

/** Anuncios / Material */

Route::get('publicacion/{id}',[AnuncioController::class, 'index']);
Route::post('public_asig_index',[AnuncioController::class, 'index_publics_maestro']);
Route::get('publicacion/{id}/create',[AnuncioController::class, 'create']);
Route::get('publicacion/{id}/edit',[AnuncioController::class, 'edit']);

Route::post('guardar_publicacion',[AnuncioController::class, 'store']);
Route::post('update_publicacion',[AnuncioController::class, 'update']);
Route::post('public_delete', [AnuncioController::class, 'destroy']);

Route::get('archivo-publics/{id}',[AnuncioController::class, 'index_files_public']);
Route::post('index_files', [AnuncioController::class, 'index_archivos']);
Route::post('guardar_archivos',[AnuncioController::class, 'Save_files']);
Route::post('file_delete', [AnuncioController::class, 'destroy_file']);

/** Tareas */
Route::get('tarea/{id}',[TareaController::class, 'index']);
Route::post('tarea_asig_index',[TareaController::class, 'index_tareas_maestro']);
Route::get('tarea/{id}/create',[TareaController::class, 'create']);
Route::get('tarea/{id}/edit',[TareaController::class, 'edit']);

Route::post('guardar_tarea',[TareaController::class, 'store']);
Route::post('update_tarea',[TareaController::class, 'update']);
Route::post('tarea_delete', [TareaController::class, 'destroy']);

Route::get('tarea/{id}/entregas',[TareaController::class, 'Entregas']);
Route::post('entregas_index',[TareaController::class, 'Entregas_index']);
Route::get('entrega/{id}',[TareaController::class, 'Entrega']);
Route::post('add_comente_entrega',[TareaController::class, 'Add_Coment_Entrega']);
Route::post('del_comente_entrega',[TareaController::class, 'Del_Coment_Entrega']);

Route::get('calificacion/{id}',[TareaController::class, 'Calificacion']);
Route::post('calificar',[TareaController::class, 'Calificar']);

/** Foro */
Route::get('foro/{id}',[ForoController::class, 'index']);
Route::post('foro_asig_index',[ForoController::class, 'index_foros']);
Route::get('foro/{id}/create',[ForoController::class, 'create']);
Route::get('foro/{id}/edit',[ForoController::class, 'edit']);

Route::post('guardar_foro',[ForoController::class, 'store']);
Route::post('update_foro',[ForoController::class, 'update']);
Route::post('foro_delete', [ForoController::class, 'destroy']);

/** Evaluación */

Route::get('evaluacion/{id}',[EvaluacionController::class, 'index']);
Route::post('evaluacion_asig_index',[EvaluacionController::class, 'index_evaluacion']);
Route::get('evaluacion/{id}/create',[EvaluacionController::class, 'create']);
Route::get('evaluacion/{id}/edit',[EvaluacionController::class, 'edit']);

Route::post('guardar_evaluacion',[EvaluacionController::class, 'store']);
Route::post('update_evaluacion',[EvaluacionController::class, 'update']);
Route::post('evaluacion_delete', [EvaluacionController::class, 'destroy']);

Route::get('evaluacion/{id}/questions',[EvaluacionController::class, 'Question']);
Route::post('preguntas_index',[EvaluacionController::class, 'index_questions']);
Route::post('add_question',[EvaluacionController::class, 'Add_Question']);
Route::post('get_suma_valor',[EvaluacionController::class, 'Suma_valor']);
Route::post('del_question',[EvaluacionController::class, 'Del_Question']);

Route::get('pregunta/{id}',[EvaluacionController::class, 'Respuestas']);
Route::post('respuestas_index',[EvaluacionController::class, 'index_respuestas']);

Route::post('add_answers',[EvaluacionController::class, 'Add_Answers']);
Route::post('del_answers',[EvaluacionController::class, 'Del_Answers']);

/** Estudiantes */

/** Publicacion */
Route::get('alumno-publicacion/{id}',[PublicacionAlumnoController::class, 'index']);
Route::post('alumno_public_index',[PublicacionAlumnoController::class, 'index_public_clase']);
Route::get('ver-publicacion/{id}',[PublicacionAlumnoController::class, 'verPublicacion']);
Route::post('coments_publics',[PublicacionAlumnoController::class, 'Comentarios']);
Route::post('add_coment',[PublicacionAlumnoController::class, 'Add_comentario']);
Route::post('del_coment',[PublicacionAlumnoController::class, 'Del_comentario']);

/** Alumno */
Route::get('alumno-tarea/{id}',[TareaAlumnoController::class, 'index']);
Route::post('alumno_tarea_index',[TareaAlumnoController::class, 'index_tarea_clase']);
Route::get('ver-tarea/{id}',[TareaAlumnoController::class, 'verTarea']);
Route::post('tarea_options',[TareaAlumnoController::class, 'Tarea_Options']);
Route::post('send_tarea',[TareaAlumnoController::class, 'Send_Tarea']);
Route::post('del_entrega',[TareaAlumnoController::class, 'Del_Entrega']);

/** Evaluacion */
Route::get('alumno-evaluacion/{id}',[EvaluacionAlumnoController::class, 'index']);
Route::post('alumno_evaluacion_index',[EvaluacionAlumnoController::class, 'index_evaluacion_clase']);
Route::get('ver-evaluacion/{id}',[EvaluacionAlumnoController::class, 'verEvaluacion']);
Route::get('ver-resultado/{id}',[EvaluacionAlumnoController::class, 'Resultado']);

Route::post('description_test',[EvaluacionAlumnoController::class, 'Description_Test']);
Route::post('start_test',[EvaluacionAlumnoController::class, 'Start_Test']);

Route::post('end_test',[EvaluacionAlumnoController::class, 'End_Test']);
Route::post('update_time_test',[EvaluacionAlumnoController::class, 'Update_Time_Test']);
Route::post('select_answer',[EvaluacionAlumnoController::class, 'Select_Answer']);