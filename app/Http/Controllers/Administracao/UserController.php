<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use ImageOptimizer;

class UserController extends Controller
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
    public function create()
    {

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
        $dados['user'] = User::find(auth()->user()->id);
        return view('administracao.pages.user.edit',$dados);
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
        $dados = $request->except("_token");
        $user  = User::find($id);
        $user->update($dados);
        return redirect()->back()->with("sucesso", "Dados atualizado " );
    }

    public function nova_foto(Request $request, $id){

        define("PASTA_IMAGEM_USER","imagens/users/");

        $user = User::find($id);

        if($request->hasFile('imagem') && $request->imagem->isValid()){

            $nomeImagem = $request->file('imagem')->hashName();

            $imagem     =  Image::make($request->file('imagem'))->orientate();

            $caminho    = $imagem->save(public_path( PASTA_IMAGEM_USER . $nomeImagem ));

            ImageOptimizer::optimize(public_path( PASTA_IMAGEM_USER . $nomeImagem ));

            $dados['imagem']     = PASTA_IMAGEM_USER . $nomeImagem;

            if(is_file($user->imagem)){
                unlink($user->imagem);
            }
            $user->update( $dados);
            return back();
            //return back()->with(['sucesso' => 'A imagem foi atualizada com sucesso.']);
         }else{
             if($request->hasFile('imagem')){
                    $errorCode = $request->file('imagem')->getError();

                    if ($errorCode == UPLOAD_ERR_INI_SIZE) {
                        return back()->with(['erro' => 'A imagem é muito pesada.']);
                    } elseif ($errorCode == UPLOAD_ERR_NO_FILE) {
                        return back()->with(['erro' => 'Nenhum imagem foi enviada.']);
                    } else {
                        return back()->with(['erro' => 'Falha ao enviar a imagem.']);
                    }
             }else{
                return back()->with(['erro' => 'Selecione uma imagem.']);
             }
         
        }
    }


    public function nova_senha(Request $request, $id){

        $senha_nova   = $request->senha_nova;
        $senha_antiga = $request->senha_antiga;
        $user         = User::find($id);

        $credentials  = [
            "email"    => $user->email,
            "password" => $senha_antiga
        ];

        if (Auth::attempt($credentials)){
            $dados["password"]  = Hash::make($senha_nova);
            $user->update($dados);
            return redirect()->back()->with("sucesso", "Senha alterada com sucesso. ");
        }else{
            return redirect()->back()->with("erro", "Senha antiga errada. ");
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
