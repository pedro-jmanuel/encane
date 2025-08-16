<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Models\FraseDia;
use App\Models\Noticia;
use App\Models\Parceiro;
use App\Models\Servico;
use App\Models\SolicitacaoServico;
use App\Models\User;

class AdministracaoController extends Controller
{

    public function home (){

        $dados['noticias']          = Noticia::orderBy('created_at','desc')->get()->take(10);
        $dados['totalParceiros']    = Parceiro::all()->count();
        $dados['totalServicos']     = Servico::all()->count();
        $dados['totalNoticias']     = Noticia::all()->count();
        $dados['totalUtilizadores'] = User::all()->count();
        $dados['totalAtendido']     = SolicitacaoServico::where("is_atendido",true)->count();

        $totalFrase = FraseDia::count();

        $aleatorio      = rand(1, $totalFrase);
        $fraseDia       = FraseDia::find($aleatorio);

        if ( $fraseDia == NULL ) {
            $dados['frase'] = '';
        } else {
            $dados['frase'] = $fraseDia->frase;
        }

        return view('administracao.pages.home',$dados);
     }
}
