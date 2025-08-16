<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["candidatos"] = Candidato::join('areas','candidatos.area_id','=','areas.id')
                                        ->select('candidatos.id','candidatos.nome_completo','candidatos.email',
                                                 'candidatos.telefone','candidatos.resumo','candidatos.curriculo','areas.nome')
                                        ->paginate(10);
        return view("administracao.pages.candidato.index",$dados);
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
        $candidato = Candidato::find($id);

        if ( $candidato == NULL ) {
            return redirect()->back()->with("erro","Candidato não encotrado .");
        } else {
            $candidato->delete();
            return redirect()->back()->with("sucesso","Candidato eliminada .");
        }
    }
}
