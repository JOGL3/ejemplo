<?php

namespace App\Http\Controllers;

use App\Paciente;
use Illuminate\Http\Request;
use DB;
use PDF;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin','med','recep']);
        $data = DB::table('pacientes')
                    ->join('sexo','pacientes.pac_sexo','sexo.sexo_id')
                    ->where('pacientes.pac_estado','=','1')
                    ->get();
        return view('paciente.index',['pacientes'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin','recep']);
        return view('paciente.create');
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
          'pac_dni' => 'required|unique:pacientes,pac_dni|numeric|digits:8',
          'pac_apellidos' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
          'pac_nombres' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
          'pac_sexo' => 'required',
          'pac_direccion' => 'nullable|max:70',
          'pac_fechnac' => 'required|before:today|after:1900-12-31',
          'pac_telefono' => 'nullable|min:7|max:13',
          'pac_email' => 'nullable'
      ]);
      $data = $request->all();
      $paciente = Paciente::create($data);
      return redirect()->route('paciente.index')->with('status', 'Paciente agregado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin','recep']);
        $paciente = Paciente::findOrFail($id);
        $sexo = DB::table('sexo')->get();
        return view('paciente.edit',['pac'=>$paciente,'sex'=>$sexo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $pac = Paciente::find($id);
      $this->validate($request,[
          'pac_dni' => 'required|unique:pacientes,pac_dni,'.$id.',pac_id|numeric|digits:8',
          'pac_apellidos' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
          'pac_nombres' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
          'pac_sexo' => 'required',
          'pac_direccion' => 'nullable|max:70',
          'pac_fechnac' => 'required|before:today|after:1900-12-31',
          'pac_telefono' => 'nullable|min:7|max:13',
          'pac_email' => 'nullable'
      ]);
      $pac->update($request->all());
      return redirect()->route('paciente.index')->with('status', 'Paciente editado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $pac = Paciente::find($id);
        $pac->pac_estado = 2;
        $pac->save();
        return redirect()->route('paciente.index')->with('status', 'Paciente eliminado correctamente!');
    }

    public function buscarhc($id)
    {
        $data = DB::table('historiasclinicas')
                ->join('citas','citas.cit_id','historiasclinicas.hc_idcitamed')
                ->join('pacientes','pacientes.pac_id','historiasclinicas.hc_idpaciente')
                ->join('empleados','empleados.emp_id','citas.cit_idempleado')
                ->where('historiasclinicas.hc_idpaciente','=',$id)
                ->get();
        $paciente = DB::table('pacientes')
                    ->where('pacientes.pac_id','=',$id)
                    ->first();
      $pdf = PDF::loadView('hclinica.pdf',['historiasclinicas'=>$data])->setPaper('a4','portrait');
      return $pdf->stream('ReporteHC.pdf');
    }

}
