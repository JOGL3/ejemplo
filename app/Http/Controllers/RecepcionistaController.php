<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class RecepcionistaController extends Controller
{

    public function index(Request $request)
    {
      $request->user()->authorizeRoles(['admin']);
      $data = DB::table('empleados')
                   ->join('sexo','empleados.emp_sexo','=','sexo.sexo_id')
                   ->join('users','empleados.emp_usuario','=','users.id')
                   ->join('role_user','role_user.user_id','=','users.id')
                   ->where('role_user.role_id','=','3')
                   ->get();
       return view('recepcion.index',['recepcionistas'=>$data]);
    }

    public function create(Request $request)
    {
      $request->user()->authorizeRoles(['admin']);
        return view('recepcion.create');
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
        $recepcionista = Empleado::create([
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
            'role_id' => '3'
        ]);
        return redirect()->route('recep.index')->with('status', 'Recepcionista agregado correctamente!');
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $data = Empleado::findOrFail($id);
        $sexo = DB::table('sexo')->get();
        return view('recepcion.edit',['recep'=>$data,'sexo'=>$sexo]);
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
        return redirect()->route('recep.index')->with('status', 'Recepcionista editado correctamente!');
    }

    public function destroy()
    {
        //
    }
}
