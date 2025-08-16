<?php

namespace App\Providers;

use App\Models\Conferencia;
use App\Models\Organizacao;
use App\Models\Servico;
use App\Models\SolicitacaoServico;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        $organizacao =  Organizacao::all()->last();
        $servicos    =  Servico::all();

        $qtdSolicitacaoPendente = SolicitacaoServico::where("is_atendido",false)->count();

        View::share("org_activa", $organizacao);
        View::share("servico_activos", $servicos);
        View::share("qtd_solicitacao_pendente", $qtdSolicitacaoPendente);
    }

}
