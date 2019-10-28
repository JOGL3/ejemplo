<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\RoleUser;
use App\User;
use App\EspecialidadMedico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class MedicoController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $data = DB::table('empleados')
                     ->join('sexo','empleados.emp_sexo','=','sexo.sexo_id')
                     ->join('users','empleados.emp_usuario','=','users.id')
                     ->join('role_user','role_user.user_id','=','users.id')
                     ->where('role_user.role_id','=','2')
                     ->get();
        return view('medico.index',['medicos'=>$data]);
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $espec = DB::table('especialidades')->get();
        return view('medico.create',['especialidades'=>$espec]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'emp_dni' => 'required|unique:empleados,emp_dni|numeric|digits:8',
            'emp_apellidos' => 'required|max:50',
            'emp_nombres' => 'required|max:50',
            'emp_sexo' => 'required',
            'emp_telefono' => 'nullable|min:7|max:13',
            'emp_email' => 'nullable'
        ]);
        $data = $request->all();
        User::create([
            'id' => $data['emp_dni'],
            'usuario' => $data['emp_dni'],
            'password' => Hash::make($data['emp_dni']),
        ]);
        $medico = Empleado::create([
            'emp_dni' => $data['emp_dni'],
            'emp_apellidos' => $data['emp_apellidos'],
            'emp_nombres' => $data['emp_nombres'],
            'emp_sexo' => $data['emp_sexo'],
            'emp_telefono' => $data['emp_telefono'],
            'emp_email' => $data['emp_email'],
            'emp_usuario' => $data['emp_dni']
        ]);
        $rol = RoleUser::create([
            'user_id' => $data['emp_dni'],
            'role_id' => '2'
        ]);

        foreach ($data['especialidades'] as $key => $value) {
            $espMed = EspecialidadMedico::create([
                'emp_id' => $medico->emp_id,
                'esp_id' => $value
            ]);
        }
        return redirect()->route('medico.index')->with('status', 'Médico agregado correctamente!');
    }

    public function show()
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $medico = Empleado::find($id);
        $sexo = DB::table('sexo')->get();
        return view('medico.edit',['med'=>$medico,'sexo'=>$sexo]);
    }


    public function update(Request $request, $id)
    {
        $recep = Empleado::find($id);
        $this->validate($request,[
            'emp_dni' => 'required|unique:empleados,emp_dni,'.$id.',emp_id|numeric|digits:8',
            'emp_apellidos' => 'required|max:50',
            'emp_nombres' => 'required|max:50',
            'emp_sexo' => 'required',
            'emp_telefono' => 'nullable|min:7|max:13',
            'emp_email' => 'nullable'
        ]);
        $request->all();
        $recep->update($request->all());
        return redirect()->route('medico.index')->with('status', 'Médico editado correctamente!');
    }

    public function destroy()
    {
        //
    }

    public function medicoPorEspecialidad($id)
    {
        $data = DB::table('especialidad_medico')
                    ->join('empleados','empleados.emp_id','=','especialidad_medico.emp_id')
                    ->where('especialidad_medico.esp_id','=',$id)
                    ->get();
        return $data;
    }

}
