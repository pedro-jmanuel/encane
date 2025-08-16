<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Membro\StoreMembroRequest;
use App\Http\Requests\Membro\UpdateMembroRequest;
use App\Models\MembroEquipe;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Auth;
use ImageOptimizer;

class MembroEquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["membros"] = MembroEquipe::orderBy('membro_equipes.created_at','desc')->paginate(10);
        return view("administracao.pages.membro.index",$dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("administracao.pages.membro.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembroRequest $request)
    {
        define("PASTA_IMAGEM_EQUIPE","imagens/membro/");

        //$request->dd();


        $width  = 500;
        $height = 800;
        $dados  = [];

            if($request->imagem){

                if($request->hasFile('imagem') && $request->imagem->isValid()){

                    $nomeImagem = $request->file('imagem')->hashName();

                    $imagem     =  Image::make($request->file('imagem'))->orientate()->resize($width,$height);

                    $caminho    = $imagem->save(public_path( PASTA_IMAGEM_EQUIPE . $nomeImagem ));

                    ImageOptimizer::optimize(public_path( PASTA_IMAGEM_EQUIPE . $nomeImagem ));

                    $dados['nome_completo'] = $request->nome_completo;
                    $dados['cargo']         = $request->cargo;
                    $dados['linkedin']      = $request->linkedin;
                    $dados['facebook']      = $request->facebook;
                    $dados['instagram']     = $request->instagram;
                    $dados['twitter']       = $request->twitter;
                    $dados['imagem']        = PASTA_IMAGEM_EQUIPE . $nomeImagem;
                    $dados["created_by"]    = Auth::user()->id;

                    MembroEquipe::create($dados);
                    return redirect()->back()->with("sucesso", "Membro publicado com sucesso ");
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
                return redirect()->back()->with("erro", "Erro ao publicar o membro ");
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
        $dados['membro'] = MembroEquipe::find($id);

        if ($dados['membro'] == NULL)
            return view('errors.404');

        return view("administracao.pages.membro.edit",$dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembroRequest $request, $id)
    {
         //$request->dd();

         $width  = 500;
         $height = 800;

         $nomeImagem = '';
         $dados = [];

         $membro = MembroEquipe::find($id);

         if ($membro != NULL) {

            if($request->imagem){

                define("PASTA_IMAGEM_EQUIPE","imagens/membro/");

                if($request->hasFile('imagem') && $request->imagem->isValid()){

                    $nomeImagem = $request->file('imagem')->hashName();

                    $imagem     =  Image::make($request->file('imagem'))->orientate()->resize($width,$height);

                    $caminho    = $imagem->save(public_path( PASTA_IMAGEM_EQUIPE . $nomeImagem ));

                    ImageOptimizer::optimize(public_path( PASTA_IMAGEM_EQUIPE . $nomeImagem ));

                    $dados['imagem']     = PASTA_IMAGEM_EQUIPE . $nomeImagem;

                    if(is_file($membro->imagem)){
                        unlink($membro->imagem);
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

            $dados['nome_completo'] = $request->nome_completo;
            $dados['cargo']         = $request->cargo;
            $dados['linkedin']      = $request->linkedin;
            $dados['facebook']      = $request->facebook;
            $dados['instagram']     = $request->instagram;
            $dados['twitter']       = $request->twitter;
            $dados["updated_by"]    = Auth::user()->id;

            $membro->update($dados);
            return redirect()->back()->with("sucesso", "Membro atualizado");
         } else {
            return redirect()->back()->with("erro", "Membro não encotrada" );
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
        $membro = MembroEquipe::find($id);

        if ( $membro == NULL ) {
            return redirect()->back()->with("erro","Membro não encotrado .");
        } else {
            $membro->delete();
            return redirect()->back()->with("sucesso","Membro eliminado .");
        }
    }
}
