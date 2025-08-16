<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Models\Inscrito;
use Illuminate\Http\Request;

class InscritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados['inscritos'] = Inscrito::paginate(20);

        return view("administracao.pages.inscrito.index",$dados);
    }

    public function destroy($id)
    {
       $inscrito = Inscrito::find($id);

        if ( $inscrito == NULL ) {
            return redirect()->back()->with("erro","Inscrito não encotrado .");
        } else {
            $inscrito->delete();
            return redirect()->back()->with("sucesso","Inscrito eliminado .");
        }
    }
}
