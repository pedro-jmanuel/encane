<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Parceiro\StoreParceiroRequest;
use App\Http\Requests\Parceiro\UpdateParceiroRequest;
use App\Models\Parceiro;
use Illuminate\Http\Request;
use Image;
use ImageOptimizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParceiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["parceiros"] = Parceiro::orderBy('parceiros.created_at','desc')->paginate(10);
        return view("administracao.pages.parceiro.index",$dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("administracao.pages.parceiro.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParceiroRequest $request)
    {
        //$request->dd();

        define("PASTA_IMAGEM_PARCEIRO","imagens/parceiros/");

        $dados = [];

            if($request->logo){

                if($request->hasFile('logo') && $request->logo->isValid()){

                    $nomeImagem = $request->file('logo')->hashName();

                    $imagem     =  Image::make($request->file('logo'))->orientate();;

                    $caminho    = $imagem->save(public_path( PASTA_IMAGEM_PARCEIRO . $nomeImagem ));

                    ImageOptimizer::optimize(public_path( PASTA_IMAGEM_PARCEIRO . $nomeImagem ));

                    $dados['logotipo']   = PASTA_IMAGEM_PARCEIRO . $nomeImagem;
                    $dados["nome"]       = $request->nome;
                    $dados["sobre"]      = $request->sobre;
                    $dados["sigla"]      = $request->sigla;
                    $dados["link_site"]  = $request->link_site;
                    $dados["created_by"] = Auth::user()->id;

                    //$request->dd();

                    Parceiro::create($dados);
                    return redirect()->back()->with("sucesso", "Associado salvo com sucesso: " . $request->titulo);
                }else{
                    return redirect()->back()->with("erro", "Erro ao salvar o associado: " . $request->nome);
                }
            }else{
                return redirect()->back()->with("erro", "Erro ao salvar o associado: " . $request->nome);
            }

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
        $dados['parceiro'] = Parceiro::find($id);
        //dd($dados);
        if ($dados['parceiro'] == NULL)
            return view('errors.404');
        return view("administracao.pages.parceiro.edit",$dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParceiroRequest $request, $id)
    {
         // $request->dd();

         $nomeImagem = '';
         $dados = [];

         $parceiro = Parceiro::find($id);

         if ($parceiro != NULL) {

            if($request->logo){

                define("PASTA_IMAGEM_PARCEIRO","imagens/parceiros/");

                if($request->hasFile('logo') && $request->logo->isValid()){

                    $nomeImagem = $request->file('logo')->hashName();

                    $imagem     =  Image::make($request->file('logo'))->orientate();;

                    $caminho    = $imagem->save(public_path( PASTA_IMAGEM_PARCEIRO . $nomeImagem ));

                    ImageOptimizer::optimize(public_path( PASTA_IMAGEM_PARCEIRO . $nomeImagem ));

                    $dados['logotipo']     = PASTA_IMAGEM_PARCEIRO . $nomeImagem;

                    if(is_file($parceiro->logo)){
                        unlink($parceiro->logo);
                    }
                 }
            }

            $dados["nome"]       = $request->nome;
            $dados["sobre"]      = $request->sobre;
            $dados["sigla"]      = $request->sigla;
            $dados["link_site"]  = $request->link_site;
            $dados["created_by"] = Auth::user()->id;

            $parceiro->update($dados);
            return redirect()->back()->with("sucesso", "Associado  atualizado com sucesso : " . $request->titulo);
         } else {
            return redirect()->back()->with("erro", "Associado não encotrado " );
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
        $parceiro = Parceiro::find($id);

        //dd($parceiro);

        if ( $parceiro == NULL ) {
            return redirect()->back()->with("erro","Associado não encotrada .");
        } else {
            $parceiro->delete();
            return redirect()->back()->with("sucesso","Associado eliminado .");
        }

    }
}
