<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Noticia\StoreNoticiaRequest;
use App\Http\Requests\Noticia\UpdateNoticiaRequest;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use ImageOptimizer;
use Illuminate\Support\Str;


class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados['noticias'] = Noticia::join("users","users.id","=","noticias.created_by")
                                    ->select("noticias.titulo","noticias.id","users.nome as autor_nome","users.sobrenome as autor_sobrenome","users.imagem as autor_imagem","noticias.created_at as data")
                                    ->orderBy('noticias.created_at','desc')
                                    ->paginate(10);
        //dd($dados['noticias']);

        return view("administracao.pages.noticia.index",$dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("administracao.pages.noticia.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticiaRequest $request)
    {

        define("PASTA_IMAGEM_NOTICIA","imagens/noticias/");

        // $request->dd();

        $width  = 1920;
        $height = 1280;
        $dados  = [];

            if($request->imagem){

                if($request->hasFile('imagem') && $request->imagem->isValid()){

                    $nomeImagem = $request->file('imagem')->hashName();

                    $imagem     =  Image::make($request->file('imagem'))->orientate()->resize($width,$height);

                    $caminho    = $imagem->save(public_path( PASTA_IMAGEM_NOTICIA . $nomeImagem ));

                    ImageOptimizer::optimize(public_path( PASTA_IMAGEM_NOTICIA . $nomeImagem ));

                    $dados['imagem']     = PASTA_IMAGEM_NOTICIA . $nomeImagem;
                    $dados["titulo"]     = $request->titulo;
                    $dados["conteudo"]   = $request->conteudo;
                    $dados["slug"]       =  Str::slug($request->titulo);
                    $dados["created_by"] = Auth::user()->id;

                    Noticia::create($dados);
                    return redirect()->back()->with("sucesso", "Notícia publicada : " . $request->titulo);
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
                return redirect()->back()->with("erro", "Erro ao publicar a notícia: " . $request->titulo);
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
        $dados['noticia'] = Noticia::find($id);

        if ($dados['noticia'] == NULL)
            return view('errors.404');

        return view("administracao.pages.noticia.edit",$dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoticiaRequest $request, $id)
    {
         // $request->dd();
         $width  = 1920;
         $height = 1280;

         $nomeImagem = '';
         $dados = [];

         $noticia = Noticia::find($id);

         if ($noticia != NULL) {

            if($request->imagem){

                define("PASTA_IMAGEM_NOTICIA","imagens/noticias/");

                if($request->hasFile('imagem') && $request->imagem->isValid()){

                    $nomeImagem = $request->file('imagem')->hashName();

                    $imagem     =  Image::make($request->file('imagem'))->orientate()->resize($width,$height);

                    $caminho    = $imagem->save(public_path( PASTA_IMAGEM_NOTICIA . $nomeImagem ));

                    ImageOptimizer::optimize(public_path( PASTA_IMAGEM_NOTICIA . $nomeImagem ));

                    $dados['imagem']     = PASTA_IMAGEM_NOTICIA . $nomeImagem;

                    if(is_file($noticia->imagem)){
                        unlink($noticia->imagem);
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

            $dados["titulo"]     = $request->titulo;
            $dados["conteudo"]   = $request->conteudo;
            $dados["slug"]       = Str::slug($request->titulo);
            $dados["created_by"] = Auth::user()->id;
            $noticia->update($dados);
            return redirect()->back()->with("sucesso", "Notícia atualizada : " . $request->titulo);
         } else {
            return redirect()->back()->with("erro", "Notícia não encotrada " );
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
       $noticia = Noticia::find($id);

        if ( $noticia == NULL ) {
            return redirect()->back()->with("erro","Noticia não encotrada .");
        } else {
            $noticia->delete();
            return redirect()->back()->with("sucesso","Noticia eliminada .");
        }
    }
}
