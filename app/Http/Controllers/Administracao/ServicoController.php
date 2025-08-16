<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Servico\StoreServicoRequest;
use App\Http\Requests\Servico\UpdateServicoRequest;
use App\Models\Servico;
use App\Models\SolicitacaoServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use ImageOptimizer;
use Illuminate\Support\Str;


class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $dados["servicos"] = Servico::paginate(10);

        return view("administracao.pages.servico.index",$dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("administracao.pages.servico.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServicoRequest $request)
    {
        define("PASTA_IMAGEM_SERVICO","imagens/servicos/");

        // $request->dd();

        $dados = [];

            if($request->imagem){

                if($request->hasFile('imagem') && $request->imagem->isValid()){

                    $nomeImagem = $request->file('imagem')->hashName();

                    $imagem     =  Image::make($request->file('imagem'))->orientate();;

                    $caminho    = $imagem->save(public_path( PASTA_IMAGEM_SERVICO . $nomeImagem ));

                    ImageOptimizer::optimize(public_path( PASTA_IMAGEM_SERVICO . $nomeImagem ));

                    $dados['imagem']     = PASTA_IMAGEM_SERVICO . $nomeImagem;
                    $dados["titulo"]     = $request->titulo;
                    $dados["conteudo"]   = $request->conteudo;
                    $dados["slug"]       = Str::slug($request->titulo);
                    $dados["created_by"] = Auth::user()->id;

                    Servico::create($dados);
                    return redirect()->back()->with("sucesso", "Serviço salvo com sucesso : " . $request->titulo);
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
                return redirect()->back()->with("erro", "Erro ao salvar o Serviço: " . $request->titulo);
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
        $dados['servico'] = Servico::find($id);
        if ($dados['servico'] == NULL)
            return view('errors.404');
        return view("administracao.pages.servico.edit",$dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateServicoRequest $request, $id)
    {
        $nomeImagem = '';
        $dados      = [];

        $servico = Servico::find($id);

        if ($servico != NULL) {

           if($request->imagem){

               define("PASTA_IMAGEM_SERVICO","imagens/noticias/");

               if($request->hasFile('imagem') && $request->imagem->isValid()){

                   $nomeImagem = $request->file('imagem')->hashName();

                   $imagem     =  Image::make($request->file('imagem'))->orientate();;

                   $caminho    = $imagem->save(public_path( PASTA_IMAGEM_SERVICO . $nomeImagem ));

                   ImageOptimizer::optimize(public_path( PASTA_IMAGEM_SERVICO . $nomeImagem ));

                   $dados['imagem']     = PASTA_IMAGEM_SERVICO . $nomeImagem;

                   if(is_file($servico->imagem)){
                       unlink($servico->imagem);
                   }
                }
           }

           $dados["titulo"]     = $request->titulo;
           $dados["conteudo"]   = $request->conteudo;
           $dados["slug"]       = Str::slug($request->titulo);
           $dados["created_by"] = Auth::user()->id;

           $servico->update($dados);

           return redirect()->back()->with("sucesso", "Serviço atualizada : " . $request->titulo);
        } else {
           return redirect()->back()->with("erro", "Serviço não encotrada " );
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
        $servico = Servico::find($id);

        if ( $servico == NULL ) {
            return redirect()->back()->with("erro","Serviço não encotrada .");
        } else {
            $servico->delete();
            return redirect()->back()->with("sucesso","Serviço eliminada .");
        }
    }

    public function solicitacoes(){
        $dados["solicitacoes"] = SolicitacaoServico::join("servicos","servicos.id","=","solicitacao_servicos.servico_id")
                                                    ->select("solicitacao_servicos.id","solicitacao_servicos.nome_completo","solicitacao_servicos.mensagem","solicitacao_servicos.is_atendido","solicitacao_servicos.telefone","solicitacao_servicos.email","servicos.titulo as titulo_servico")
                                                    ->paginate(10);

        return view("administracao.pages.servico.solicitacoes",$dados);
    }

    public function solicitacoes_destroy($id)
    {
        $servico = SolicitacaoServico::find($id);

        if ( $servico == NULL ) {
            return redirect()->back()->with("erro","Solicitação de serviço não encotrada .");
        } else {
            $servico->delete();
            return redirect()->back()->with("sucesso","Solicitação de serviço eliminada .");
        }
    }

    public function solicitacoes_atendimento($id){

        $servico = SolicitacaoServico::find($id);

        if ( $servico == NULL ) {
            return redirect()->back()->with("erro","Solicitação de serviço não encotrada .");
        } else {
            $dados['is_atendido'] = ! $servico->is_atendido;
            $servico->update($dados);
            return redirect()->back()->with("sucesso","Estado de atendimento alterado com sucesso.");
        }
    }

}
