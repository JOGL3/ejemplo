<?php

namespace App\Http\Controllers;

use App\HistoriaClinica;
use App\Cita;
use Illuminate\Http\Request;
use PDF;
use DB;

class HistoriaClinicaController extends Controller
{
    public function recibircita($id)
    {
        $data = DB::table('citas')
                ->join('pacientes','citas.cit_idpaciente','=','pacientes.pac_id')
                ->where('citas.cit_id','=',$id)
                ->first();
        $cie10 = DB::table('cie10')->get();
        return view('hclinica.create',['cita'=>$data,'cie10'=>$cie10]);
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin','med','recep']);
        $data = DB::table('historiasclinicas')
                  ->join('citas','historiasclinicas.hc_idcitamed','citas.cit_id')
                  ->join('especialidades','especialidades.esp_id','citas.cit_idespec')
                  ->join('pacientes','pacientes.pac_id','citas.cit_idpaciente')
                  ->join('empleados','empleados.emp_id','citas.cit_idempleado')
                  ->get();
        return view('hclinica.index',['historiasclinicas'=>$data]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'hc_idpaciente' => 'required',
            'hc_idcitamed' => 'required',
            'hc_idcie10' => 'required',
            'hc_alergias' => 'nullable',
            'hc_hta' => 'nullable',
            'hc_dm' => 'nullable',
            'hc_anamnesis' => 'nullable',
            'hc_pa' => 'nullable',
            'hc_fc' => 'nullable',
            'hc_t' => 'nullable',
            'hc_fr' => 'nullable',
            'hc_peso' => 'nullable',
            'hc_aspectogeneral' => 'nullable',
            'hc_estadoconciencia' => 'nullable',
            'hc_piel' => 'nullable',
            'hc_cabeza' => 'nullable',
            'hc_cuello' => 'nullable',
            'hc_torax' => 'nullable',
            'hc_cardiovascular' => 'nullable',
            'hc_abdomen' => 'nullable',
            'hc_genitouriano' => 'nullable',
            'hc_osteomuscular' => 'nullable',
            'hc_neurologico' => 'nullable',
            'hc_diagnostico' => 'nullable',
            'hc_tratamiento' => 'nullable',
            'hc_ss1' => 'nullable',
            'hc_dc1' => 'nullable',
            'hc_res1' => 'nullable',
            'hc_ss2' => 'nullable',
            'hc_dc2' => 'nullable',
            'hc_res2' => 'nullable',
            'hc_ss3' => 'nullable',
            'hc_dc3' => 'nullable',
            'hc_res3' => 'nullable'
        ]);
        $data = $request->all();
        $hc = HistoriaClinica::create([
          'hc_idpaciente' => $data['hc_idpaciente'],
          'hc_idcitamed' => $data['hc_idcitamed'],
          'hc_idcie10' => $data['hc_idcie10'],
          'hc_alergias' => $data['hc_alergias'],
          'hc_hta' => $data['hc_hta'],
          'hc_dm' => $data['hc_dm'],
          'hc_anamnesis' => $data['hc_anamnesis'],
          'hc_pa' => $data['hc_pa'],
          'hc_fc' => $data['hc_fc'],
          'hc_t' => $data['hc_t'],
          'hc_fr' => $data['hc_fr'],
          'hc_peso' => $data['hc_peso'],
          'hc_aspectogeneral' => $data['hc_aspectogeneral'],
          'hc_estadoconciencia' => $data['hc_estadoconciencia'],
          'hc_piel' => $data['hc_piel'],
          'hc_cabeza' => $data['hc_cabeza'],
          'hc_cuello' => $data['hc_cuello'],
          'hc_torax' => $data['hc_torax'],
          'hc_cardiovascular' => $data['hc_cardiovascular'],
          'hc_abdomen' => $data['hc_abdomen'],
          'hc_genitouriano' => $data['hc_genitouriano'],
          'hc_osteomuscular' => $data['hc_osteomuscular'],
          'hc_neurologico' => $data['hc_neurologico'],
          'hc_diagnostico' => $data['hc_diagnostico'],
          'hc_tratamiento' => $data['hc_tratamiento'],
          'hc_ss1' => $data['hc_ss1'],
          'hc_dc1' => $data['hc_dc1'],
          'hc_res1' => $data['hc_res1'],
          'hc_ss2' => $data['hc_ss2'],
          'hc_dc2' => $data['hc_dc2'],
          'hc_res2' => $data['hc_res2'],
          'hc_ss3' => $data['hc_ss3'],
          'hc_dc3' => $data['hc_dc3'],
          'hc_res3' => $data['hc_res3']
        ]);
        $cita = Cita::find($data['hc_idcitamed']);
        $cita->cit_estado = 1;
        $cita->save();
        return redirect()->route('historiaclinica.index')->with('status', 'Historia Clinica registrada correctamente!');
    }

    public function imprimirhc($id)
    {
        $data = DB::table('historiasclinicas')
                  ->join('citas','historiasclinicas.hc_idcitamed','citas.cit_id')
                  ->join('especialidades','especialidades.esp_id','citas.cit_idespec')
                  ->join('pacientes','pacientes.pac_id','citas.cit_idpaciente')
                  ->join('empleados','empleados.emp_id','citas.cit_idempleado')
                  ->where('historiasclinicas.hc_id','=',$id)
                  ->get();
        $pdf = PDF::loadView('hclinica.pdf',['historiasclinicas'=>$data])->setPaper('a4','portrait');
        return $pdf->stream('ReporteHC.pdf');
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy()
    {
        //
    }
}
