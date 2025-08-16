<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Models\Organizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use ImageOptimizer;
use Illuminate\Support\Str;

class OrganizacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["organizacoes"] = Organizacao::orderBy('organizacaos.created_at','desc')->paginate(10);

        return view("administracao.pages.organizacao.index",$dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $qtdOrganizacao = Organizacao::all()->count();
        $dados["disable_btn"]  = $qtdOrganizacao >= 1;
        return view("administracao.pages.organizacao.create",$dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->dd();

        define("PASTA_IMAGEM_ORG","imagens/organizacao/");

        // $request->dd();

         $dados = [];

             if($request->logo){

                 if($request->hasFile('logo') && $request->logo->isValid()){

                     $nomeImagem = $request->file('logo')->hashName();

                     $imagem     =  Image::make($request->file('logo'))->orientate();;

                     $caminho    = $imagem->save(public_path( PASTA_IMAGEM_ORG . $nomeImagem ));

                     ImageOptimizer::optimize(public_path( PASTA_IMAGEM_ORG . $nomeImagem ));

                     $dados['logo']       = PASTA_IMAGEM_ORG . $nomeImagem;
                     $dados["nome"]       = $request->nome;
                     $dados["telefone_1"] = $request->telefone_1;
                     $dados["telefone_2"] = $request->telefone_2;
                     $dados["email"	]     = $request->email;
                     $dados["endereco"] = $request->email;
                     $dados["resumo"]     = $request->resumo;
                     $dados["sobre"]      = $request->sobre;
                     $dados["created_by"] = Auth::user()->id;

                     Organizacao::create($dados);
                     return redirect()->back()->with("sucesso", "Organização salvo com sucesso : " . $request->nome);
                 }else{
                    $errorCode = $request->file('imagem')->getError();

                    if ($errorCode == UPLOAD_ERR_INI_SIZE) {
                        return back()->with(['erro' => 'A imagem é muito pesada.']);
                    } elseif ($errorCode == UPLOAD_ERR_NO_FILE) {
                        return back()->with(['erro' => 'Nenhum imagem foi enviada.']);
                    } else {
                        return back()->with(['erro' => 'Falha ao enviar a imagem.']);
                    }
                }
            }else{
                     return redirect()->back()->with("erro", "Erro ao salvar organização: " . $request->nome);
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
        $dados['organizacao'] = Organizacao::find($id);
        if ($dados['organizacao'] == NULL)
            return view('errors.404');
        return view("administracao.pages.organizacao.edit",$dados);
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
        //$request->dd();

         $nomeImagem = '';
         $dados = [];

         $organizacao = Organizacao::find($id);

         if ($organizacao != NULL) {

            if($request->logo){

                define("PASTA_IMAGEM_ORG","imagens/organizacao/");

                if($request->hasFile('logo') && $request->logo->isValid()){

                    $nomeImagem = $request->file('logo')->hashName();

                    $imagem     =  Image::make($request->file('logo'))->orientate();;

                    $caminho    = $imagem->save(public_path( PASTA_IMAGEM_ORG . $nomeImagem ));

                    ImageOptimizer::optimize(public_path( PASTA_IMAGEM_ORG . $nomeImagem ));

                    $dados['logo']     = PASTA_IMAGEM_ORG . $nomeImagem;

                    if(is_file($organizacao->logo)){
                        unlink($organizacao->logo);
                    }
                 }else{
                    $errorCode = $request->file('imagem')->getError();

                    if ($errorCode == UPLOAD_ERR_INI_SIZE) {
                        return back()->with(['erro' => 'A imagem é muito pesada.']);
                    } elseif ($errorCode == UPLOAD_ERR_NO_FILE) {
                        return back()->with(['erro' => 'Nenhum imagem foi enviada.']);
                    } else {
                        return back()->with(['erro' => 'Falha ao enviar a imagem.']);
                    }
                }
            }

            $dados["nome"]       = $request->nome;
            $dados["telefone_1"] = $request->telefone_1;
            $dados["telefone_2"] = $request->telefone_2;
            $dados["email"	]    = $request->email;
            $dados["endereco"]   = $request->endereco;
            $dados["resumo"]     = $request->resumo;
            $dados["sobre"]      = $request->sobre;
            $dados["updated_by"] = Auth::user()->id;


            $organizacao->update($dados);
            return redirect()->back()->with("sucesso", "Organização atualizada : " . $request->nome);
         } else {
            return redirect()->back()->with("erro", "Organização não encotrada " );
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
        return redirect()->back()->with("erro", "Não pode eliminar a organização  !   " );
    }
}
