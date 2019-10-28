<?php

namespace App\Http\Controllers;

use App\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin','med','recep']);
        if ($request->user()->hasrole('med')) {
            $mydatos = DB::table('empleados')
                        ->where('empleados.emp_dni','=',Auth::user()->usuario)->first();
            $data = DB::table('citas')
            ->join('pacientes','citas.cit_idpaciente','pacientes.pac_id')
            ->join('empleados','citas.cit_idempleado','empleados.emp_id')
            ->join('especialidades','citas.cit_idespec','especialidades.esp_id')
            ->join('estado_cita','citas.cit_estado','estado_cita.ec_id')
            ->where('citas.cit_idempleado','=',$mydatos->emp_id)
            ->get();
        } else {
          $data = DB::table('citas')
                  ->join('pacientes','citas.cit_idpaciente','pacientes.pac_id')
                  ->join('empleados','citas.cit_idempleado','empleados.emp_id')
                  ->join('especialidades','citas.cit_idespec','especialidades.esp_id')
                  ->join('estado_cita','citas.cit_estado','estado_cita.ec_id')
                  ->get();
        }
        return view('cita.index',['citas'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin','recep']);
        $pac = DB::table('pacientes')
                ->orderBy('pacientes.pac_apellidos','asc')
                ->get();
        $esp = DB::table('especialidades')
                ->orderBy('especialidades.esp_nombre','asc')
                ->get();
        return view('cita.create',['pacientes'=>$pac,'especialidades'=>$esp]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'cit_idpaciente' => 'required',
            'cit_idempleado' => 'required',
            'cit_idespec' => 'required',
            'cit_fecha' => 'required',
            'cit_hora' => 'required'
        ]);
        $data = $request->all();
        $cita = Cita::create([
          'cit_idpaciente' => $data['cit_idpaciente'],
          'cit_idempleado' => $data['cit_idempleado'],
          'cit_idespec' => $data['cit_idespec'],
          'cit_fecha' => $data['cit_fecha'],
          'cit_hora' => $data['cit_hora']
        ]);
        return redirect()->route('cita.index')->with('status', 'Cita programada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function edit(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cita $cita)
    {
        //
    }
}
