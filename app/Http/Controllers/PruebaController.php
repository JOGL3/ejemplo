<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\reniec\reniec;
use App\reniec\curl;

class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buscador');
    }

    public function buscarDni(Request $request)
    {
        if ($request->ajax()) {
            $dni=$request->get('dni');
            $persona = new Reniec();
            $yo = $persona->search( $dni );
            if (is_null($yo)) {
                $data=array('estado' => false);
                echo json_encode($data);
            }else{
                if( $yo->success==true )
                {
                    $data=array(
                        'dni' => $yo->result->DNI,
                        'codveri' => $yo->result->CodVerificacion,
                        'nombres' => $yo->result->Nombres,
                        'apellidos' => $yo->result->Apellidos,
                        'grupovota' => $yo->result->gvotacion,
                        'distrito' => $yo->result->Distrito,
                        'provincia' => $yo->result->Provincia,
                        'departamento' => $yo->result->Departamento,
                        'estado' => $yo->success
                    );
                    echo json_encode($data);
                }else{
                    $data=array('estado' => $yo->success);
                    echo json_encode($data);
                }
            }

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
    public function update(Request $request, $id)
    {
        //
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
