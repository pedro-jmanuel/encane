<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plano\StorePlanoRequest;
use App\Http\Requests\Plano\UpdatePlanoRequest;
use App\Models\Plano;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["planos"] = Plano::orderBy('planos.created_at','desc')->paginate(10);
        return view("administracao.pages.plano.index",$dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("administracao.pages.plano.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlanoRequest $request)
    {
        $dados = $request->except("_token");
        $dados['created_by'] = auth()->user()->id;
        //dd($dados);
        Plano::create($dados);
        return redirect()->back()->with("sucesso", "Plano publicado : ");
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
        $dados['plano'] = Plano::find($id);
        //dd($dados);

        if ($dados['plano'] == NULL)
            return view('errors.404');

        return view("administracao.pages.plano.edit",$dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanoRequest $request, $id)
    {
        $plano = Plano::find($id);
        //dd($plano);
        if( $plano != NULL){
           $dados = $request->except("_token");
           $dados["updated_by_by"] = Auth::user()->id;

           $plano->update($dados);

           return redirect()->back()->with("sucesso", "Plano atualizado com sucesso ");
        } else {
           return redirect()->back()->with("erro", "Plano não encotrada " );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plano = Plano::find($id);

        if ( $plano == NULL ) {
            return redirect()->back()->with("erro","Plano não encotrado .");
        } else {
            $plano->delete();
            return redirect()->back()->with("sucesso","Plano eliminado .");
        }
    }
}
