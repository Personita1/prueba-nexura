<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Roles;
use App\Models\Area;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::with(['area'])->get();
        $roles = Roles::all();
        $areas = Area::all();
        //dd($empleados[0]->sexo);

        return view('empleados.index',['empleados' => $empleados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        //
        $roles = Roles::all();
        $areas = Area::all();


        return view('empleados.crear',['roles' => $roles, 'areas' => $areas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email:rfc',
            'area_id' => 'required',
            'roles' => 'required',
            'boletin' => 'boolean',
            'sexo' => 'required'
        ]);

        $datosEmpleado = $request->except(['_token', 'roles']);
        $datosEmpleado['boletin'] = array_key_exists('boletin', $datosEmpleado) ? 1 : 0;
        $empleado = Empleado::create($datosEmpleado);
        $empleado->rol()->sync($request->roles);
        return redirect('/listado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $roles = Roles::all();
        $areas = Area::all();

        $empleado = Empleado::find($request->id);

        return view('empleados.editar',['empleado'=>$empleado, 'roles' => $roles, 'areas' => $areas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email:rfc',
            'area_id' => 'required',
            'roles' => 'required',
            'boletin' => 'boolean',
            'sexo' => 'required'
        ]);

        $datosEmpleado = $request->except(['_token', 'roles']);
        $datosEmpleado['boletin'] = array_key_exists('boletin', $datosEmpleado) ? 1 : 0;
        $empleado = Empleado::where('id', $request->id)->update($datosEmpleado);

        $empleadoAct = Empleado::find($request->id);
        $empleadoAct->rol()->sync($request->roles);
        return redirect('/listado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        //dd($request);

        $empleado = Empleado::find($request->id);
        $empleado->delete();
        return redirect('/listado');
    }
}
