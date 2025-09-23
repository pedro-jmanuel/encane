<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Administracao\AdministracaoController;
use App\Http\Controllers\Administracao\AreaController;
use App\Http\Controllers\Administracao\CandidatoController;
use App\Http\Controllers\Administracao\ElementoController;
use App\Http\Controllers\Administracao\InscritoController;
use App\Http\Controllers\Administracao\LoginController;
use App\Http\Controllers\Administracao\MembroEquipeController;
use App\Http\Controllers\Administracao\NoticiaController;
use App\Http\Controllers\Administracao\OrganizacaoController;
use App\Http\Controllers\Administracao\PaginaController;
use App\Http\Controllers\Administracao\ParceiroController;
use App\Http\Controllers\Administracao\PlanoController;
use App\Http\Controllers\Administracao\ServicoController;
use App\Http\Controllers\Administracao\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routas Site

Route::get('/', [SiteController::class, 'index'])->name('index');

Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');

Route::get('/noticia/{slug}', [SiteController::class, 'noticia'])->name('noticia');

Route::get('/noticias', [SiteController::class, 'noticias'])->name('noticias');

Route::get('/parceiros', [SiteController::class, 'parceiros'])->name('parceiros');

Route::get('/servico/{slug}', [SiteController::class, 'servico'])->name('servico');

Route::get('/carreira', [SiteController::class, 'carreira'])->name('carreira');

Route::post('/candidatar-se', [SiteController::class, 'candidatar_se'])->name('candidatar_se');

Route::get('/contacto', [SiteController::class, 'contacto'])->name('contacto');

Route::get('/organigrama', [SiteController::class, 'organigrama'])->name('organigrama');

Route::post('/inscrito-novidades', [SiteController::class, 'store_inscrito'])->name('store_inscrito');

Route::post('/solicitar-servico', [SiteController::class, 'solicitar_servico'])->name('solicitar_servico');

// Routas Administracao

Route::get('/login', [LoginController::class, 'create'])->name('login.create');

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout')->middleware('auth');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [AdministracaoController::class, 'home'])->name('home');


    Route::resource('sales/category', App\Http\Controllers\Modules\Sales\CategoryController::class)->names('sales.category');
    Route::resource('sales/item', App\Http\Controllers\Modules\Sales\ItemController::class)->names('sales.item');
    Route::resource('sales/order', App\Http\Controllers\Modules\Sales\OrderController::class)->names('sales.order');
    Route::resource('sales/invoice', App\Http\Controllers\Modules\Sales\InvoiceController::class)->names('sales.invoice');
    Route::get('sales/pdf/invoice/{invoice}', [App\Http\Controllers\Modules\Sales\PdfDocumentsController::class, 'invoice_pdf'])->name('sales.pdf.invoice');
    Route::get('sales/pdf/credit_note/{invoice}', [App\Http\Controllers\Modules\Sales\PdfDocumentsController::class, 'credit_note_pdf'])->name('sales.pdf.credit_note');
    Route::resource('sales/credit-note', App\Http\Controllers\Modules\Sales\CreditNoteController::class)->names('sales.credit_note');
    Route::resource('sales/payment', App\Http\Controllers\Modules\Sales\PaymentController::class)->names('sales.payment');


    // Routas Organizacao

    Route::get('/organizacao-create', [OrganizacaoController::class, 'create'])->name('organizacao.create');

    Route::post('/organizacao-store', [OrganizacaoController::class, 'store'])->name('organizacao.store');

    Route::get('/organizacao-index', [OrganizacaoController::class, 'index'])->name('organizacao.index');

    Route::get('/organizacao/{id}/destroy', [OrganizacaoController::class, 'destroy'])->name('organizacao.destroy');

    Route::get('/organizacao/{id}/edit', [OrganizacaoController::class, 'edit'])->name('organizacao.edit');

    Route::post('/organizacao/{id}/update', [OrganizacaoController::class, 'update'])->name('organizacao.update');


    // Routas Noticias

    Route::get('/noticia-create', [NoticiaController::class, 'create'])->name('noticia.create');

    Route::post('/noticia-store', [NoticiaController::class, 'store'])->name('noticia.store');

    Route::get('/noticia-index', [NoticiaController::class, 'index'])->name('noticia.index');

    Route::get('/noticia/{id}/destroy', [NoticiaController::class, 'destroy'])->name('noticia.destroy');

    Route::get('/noticia/{id}/edit', [NoticiaController::class, 'edit'])->name('noticia.edit');

    Route::post('/noticia/{id}/update', [NoticiaController::class, 'update'])->name('noticia.update');

    // Routas Parceiro ou Associados

    Route::get('/parceiro-create', [ParceiroController::class, 'create'])->name('parceiro.create');

    Route::post('/parceiro-store', [ParceiroController::class, 'store'])->name('parceiro.store');

    Route::get('/parceiro-index', [ParceiroController::class, 'index'])->name('parceiro.index');

    Route::get('/parceiro/{id}/destroy', [ParceiroController::class, 'destroy'])->name('parceiro.destroy');

    Route::get('/parceiro/{id}/edit', [ParceiroController::class, 'edit'])->name('parceiro.edit');

    Route::post('/parceiro/{id}/update', [ParceiroController::class, 'update'])->name('parceiro.update');

    // Routas Servico

    Route::get('/servico-create', [ServicoController::class, 'create'])->name('servico.create');

    Route::post('/servico-store', [ServicoController::class, 'store'])->name('servico.store');

    Route::get('/servico-index', [ServicoController::class, 'index'])->name('servico.index');

    Route::get('/servico/{id}/destroy', [ServicoController::class, 'destroy'])->name('servico.destroy');

    Route::get('/servico/{id}/edit', [ServicoController::class, 'edit'])->name('servico.edit');

    Route::post('/servico/{id}/update', [ServicoController::class, 'update'])->name('servico.update');

    Route::get('/servico-solicitacoes', [ServicoController::class, 'solicitacoes'])->name('servico.solicitacoes');

    Route::get('/servico-solicitacao/{id}/destroy', [ServicoController::class, 'solicitacoes_destroy'])->name('solicitacao.destroy');

    Route::get('/servico-atendimento/{id}', [ServicoController::class, 'solicitacoes_atendimento'])->name('solicitacao.atendimento');

     // Routas User


     Route::get('/user-index', [UserController::class, 'index'])->name('user.index');

     Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

     Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');

     Route::post('/user/{id}/nova-foto', [UserController::class, 'nova_foto'])->name('user.nova_foto');

     Route::post('/user/{id}/nova-senha', [UserController::class, 'nova_senha'])->name('user.nova_senha');

    //Routas inscrito

    Route::get('/inscrito-index', [InscritoController::class, 'index'])->name('inscrito.index');

    Route::get('/inscrito/{id}/destroy', [InscritoController::class, 'destroy'])->name('inscrito.destroy');
     // Routas Plano

     Route::get('/plano-create', [PlanoController::class, 'create'])->name('plano.create');

     Route::post('/plano-store', [PlanoController::class, 'store'])->name('plano.store');

     Route::get('/plano-index', [PlanoController::class, 'index'])->name('plano.index');

     Route::get('/plano/{id}/destroy', [PlanoController::class, 'destroy'])->name('plano.destroy');

     Route::get('/plano/{id}/edit', [PlanoController::class, 'edit'])->name('plano.edit');

     Route::post('/plano/{id}/update', [PlanoController::class, 'update'])->name('plano.update');

     // Routas Membro da Equipe

     Route::get('/membro-create', [MembroEquipeController::class, 'create'])->name('membro.create');

     Route::post('/membro-store', [MembroEquipeController::class, 'store'])->name('membro.store');

     Route::get('/membro-index', [MembroEquipeController::class, 'index'])->name('membro.index');

     Route::get('/membro/{id}/destroy', [MembroEquipeController::class, 'destroy'])->name('membro.destroy');

     Route::get('/membro/{id}/edit', [MembroEquipeController::class, 'edit'])->name('membro.edit');

     Route::post('/membro/{id}/update', [MembroEquipeController::class, 'update'])->name('membro.update');


     // Routas Paginas

      Route::get('/pagina-create', [PaginaController::class, 'create'])->name('pagina.create');

      Route::post('/pagina-store', [PaginaController::class, 'store'])->name('pagina.store');

      Route::get('/pagina-index', [PaginaController::class, 'index'])->name('pagina.index');

      Route::get('/pagina/{id}/destroy', [PaginaController::class, 'destroy'])->name('pagina.destroy');

      Route::get('/pagina/{id}/edit', [PaginaController::class, 'edit'])->name('pagina.edit');

      Route::post('/pagina/{id}/update', [PaginaController::class, 'update'])->name('pagina.update');

      // Routas Elemento

      Route::get('/elemento-create/{pagina_id}', [ElementoController::class, 'create'])->name('elemento.create');

      Route::post('/elemento-store', [ElementoController::class, 'store'])->name('elemento.store');

      Route::get('/elemento-index', [ElementoController::class, 'index'])->name('elemento.index');

      Route::get('/elemento/{id}/destroy', [ElementoController::class, 'destroy'])->name('elemento.destroy');

      Route::get('/elemento/{id}/edit', [ElementoController::class, 'edit'])->name('elemento.edit');

      Route::get('/elemento/{pagina_id}/edit-all', [ElementoController::class, 'edit_all'])->name('elemento.edit_all');

      Route::post('/elemento/{id}/update', [ElementoController::class, 'update'])->name('elemento.update');

      // Routas Area

      Route::get('/area-create', [AreaController::class, 'create'])->name('area.create');

      Route::post('/area-store', [AreaController::class, 'store'])->name('area.store');

      Route::get('/area-index', [AreaController::class, 'index'])->name('area.index');

      Route::get('/area/{id}/destroy', [AreaController::class, 'destroy'])->name('area.destroy');

      Route::get('/area/{id}/edit', [AreaController::class, 'edit'])->name('area.edit');

      Route::post('/area/{id}/update', [AreaController::class, 'update'])->name('area.update');

       // Routas Candidato

      Route::get('/candidato-index', [CandidatoController::class, 'index'])->name('candidato.index');

      Route::get('/candidato/{id}/destroy', [CandidatoController::class, 'destroy'])->name('candidato.destroy');

});


Route::get('servico-email', [SiteController::class, 'servico_email'])->name('servico_email');
