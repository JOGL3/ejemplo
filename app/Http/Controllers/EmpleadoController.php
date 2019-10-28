<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\RoleUser;
use Illuminate\Http\Request;
use DB;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $data = DB::table('empleados')
                     ->join('users','empleados.emp_usuario','=','users.id')
                     ->join('role_user','role_user.user_id','=','users.id')
                     ->join('roles','roles.id','=','role_user.role_id')
                     ->get();
        return view('empleado.index',['empleados'=>$data]);
    }

    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
        $empleado = DB::table('empleados')
                    ->join('users','empleados.emp_usuario','=','users.id')
                    ->join('role_user','role_user.user_id','=','users.id')
                    ->join('roles','roles.id','=','role_user.role_id')
                    ->where('empleados.emp_id','=', $id)
                    ->first();
        $roles = DB::table('roles')->get();
        return view('empleado.edit',['emp'=>$empleado,'roles'=>$roles]);
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        $this->validate($request,[
            'emp_dni' => 'required|unique:empleados,emp_dni,'.$id.',emp_id|numeric|digits:8',
            'emp_apellidos' => 'required|max:50',
            'emp_nombres' => 'required|max:50',
            'role_id' => 'required'
        ]);
        $request->all();
        $roluser = RoleUser::where('user_id',$empleado->emp_dni)->first();
        $roluser->role_id = $request['role_id'];
        $roluser->save();
        return redirect()->route('empleado.index')->with('status', 'Empleado editado correctamente!');
    }

}
