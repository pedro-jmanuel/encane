<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Elemento\StoreElementoRequest;
use App\Http\Requests\Elemento\UpdateElementoRequest;
use App\Models\Elemento;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Image;
use ImageOptimizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ElementoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dados["pagina"]  = Pagina::find($request->pagina_id);
        return view("administracao.pages.elemento.create",$dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreElementoRequest $request)
    {
        //$request->dd();
        $width  = 1920;
        $height = 1280;

        $nomeImagem = '';
        $dados      = [];

        if(Elemento::existe($request->titulo))
            return redirect()->back()->with("erro", "O elemento já existe: " . $request->titulo);

        if($request->imagem){

               define("PASTA_IMAGEM_ELEMENTO","imagens/elementos/");

               if($request->hasFile('imagem') && $request->imagem->isValid()){

                   $nomeImagem = $request->file('imagem')->hashName();

                   $imagem     =  Image::make($request->file('imagem'))->orientate()->resize($width,$height);

                   $caminho    = $imagem->save(public_path( PASTA_IMAGEM_ELEMENTO . $nomeImagem ));

                   ImageOptimizer::optimize(public_path( PASTA_IMAGEM_ELEMENTO . $nomeImagem ));

                   $dados['imagem']     = PASTA_IMAGEM_ELEMENTO . $nomeImagem;

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

           $dados["identificador"] = Str::slug($request->titulo,'_');
           $dados["pagina_id"]     = $request->pagina_id;
           $dados["titulo"]        = $request->titulo;
           $dados["conteudo"]      = $request->conteudo;
           $dados["created_by"]    = Auth::user()->id;
           Elemento::create($dados);
           return redirect()->back()->with("sucesso", "Elemento salvo com sucesso :  " . $request->titulo );
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

    public function edit_all($pagina_id)
    {   $dados["pagina"]    = Pagina::find($pagina_id);
        $dados["elementos"] = Elemento::where("pagina_id",$pagina_id)->get();
        return view("administracao.pages.elemento.edit_all",$dados);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateElementoRequest $request, $id)
    {
        //$request->dd();
        $width  = 1920;
        $height = 1280;

        $nomeImagem = '';
        $dados = [];

        $elemento = Elemento::find($id);

        if ($elemento != NULL) {

           if($request->imagem){

               define("PASTA_IMAGEM_ELEMENTO","imagens/elementos/");

               if($request->hasFile('imagem') && $request->imagem->isValid()){

                   $nomeImagem = $request->file('imagem')->hashName();

                   $imagem     =  Image::make($request->file('imagem'))->orientate()->resize($width,$height);

                   $caminho    = $imagem->save(public_path( PASTA_IMAGEM_ELEMENTO . $nomeImagem ));

                   ImageOptimizer::optimize(public_path( PASTA_IMAGEM_ELEMENTO . $nomeImagem ));

                   $dados['imagem']     = PASTA_IMAGEM_ELEMENTO . $nomeImagem;

                   if(is_file($elemento->imagem)){
                       unlink($elemento->imagem);
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
           $dados["updated_by"] = Auth::user()->id;
          // dd($dados);
           $elemento->update($dados);
           return redirect()->back()->with("sucesso", "Elemento atualizado com sucesso :  " . $request->titulo );
        } else {
           return redirect()->back()->with("erro", "Elemento não encotrado " );
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
        //
    }
}
