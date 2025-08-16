<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Candidato;
use App\Models\Inscrito;
use App\Models\MembroEquipe;
use App\Models\Noticia;
use App\Models\Organizacao;
use App\Models\Pagina;
use App\Models\Parceiro;
use App\Models\Plano;
use App\Models\Servico;
use App\Models\SolicitacaoServico;
use Illuminate\Http\Request;
use stdClass;
use Svg\Tag\Rect;

class SiteController extends Controller
{

    public function index (){
        $dados = [];

        $organizacao             = Organizacao::all()->last();

        $dados["noticias"]       = Noticia::orderBy('created_at','desc')->get()->take(3);
        $dados["totalParceiros"] = Parceiro::all()->count();
        $dados["servicos"]       = Servico::all();
        $dados["planos"]         = Plano::orderBy('created_at','desc')->get()->take(3);
        $dados["membros"]        = MembroEquipe::orderBy('created_at','desc')->get()->take(3);

        $dados["meta_title"]          = $organizacao->nome;
        $dados["meta_description"]    = $organizacao->resumo;
        $dados["meta_url"]            = route('index');
        $dados["meta_image"]          = $organizacao->logo;

        $elementos = Pagina::allElementos("index");

        //dd($elementos);

        return view("site.pages.index",$dados,$elementos);

       //return view("site.master");
    }

    public function sobre(){

        $dados["meta_title"]       = "Sobre";
        $dados["organizacao"] = Organizacao::all()->last();

        return view("site.pages.sobre",$dados);
     }

    public function noticias (){

       $dados["meta_title"] = "Notícias";

       $dados['noticias'] = Noticia::join("users","users.id","=","noticias.created_by")
                                    ->select("noticias.slug","noticias.titulo","noticias.imagem","noticias.id","noticias.conteudo","users.nome as autor_nome","users.sobrenome as autor_sobrenome","users.imagem as autor_imagem","noticias.created_at as data")
                                    ->orderBy('noticias.created_at','desc')
                                    ->paginate(5);

        $dados["noticiasRecentes"] = Noticia::orderBy('created_at','desc')->get()->take(3);

       return view("site.pages.noticias",$dados);
    }

    public  function noticia($slug){

        $dados['noticia'] = Noticia::join("users","users.id","=","noticias.created_by")
                                    ->select("noticias.slug","noticias.titulo","noticias.imagem","noticias.id","noticias.conteudo","users.nome as autor_nome","users.sobrenome as autor_sobrenome","users.imagem as autor_imagem","noticias.created_at as data")
                                    ->where("slug",'LIKE','%'.$slug.'%')
                                    ->get()
                                    ->first();

        if ( $dados['noticia'] == NULL) return view('errors.404');

        $dados["noticiasRecentes"]    = Noticia::orderBy('created_at','desc')->get()->take(3);

        $dados["meta_title"]          = $dados['noticia']->titulo;
        $dados["meta_description"]    = 'Saiba mais, Clicando no link !';
        $dados["meta_url"]            = '';
        $dados["meta_image"]          = $dados['noticia']->imagem;

        return view("site.pages.noticia",$dados);
    }

    public function parceiros (){

        $dados["meta_title"] = "Associados";

        $dados["parceiros"] = Parceiro::all();

        return view("site.pages.parceiros",$dados);
    }

    public function servico($slug){

        $dados["meta_title"]   = "Serviço";

        $dados['servico'] = Servico::where("slug",$slug)
                                    ->get()->first();
        
        $dados["noticiasRecentes"]    = Noticia::orderBy('created_at','desc')->get()->take(3);

        if ( $dados['servico'] == NULL ) return view('errors.404');

        return view("site.pages.servico",$dados);
    }

    public function carreira(){

        $dados["meta_title"]   = "Carreira";
        $dados["areas"]         = Area::all();

        return view("site.pages.carreira",$dados);
    }

    public function organigrama (){

        $dados["meta_title"] = "Organigrama";

        return view("site.pages.organigrama",$dados);
    }

    public function contacto(){

        $dados["meta_title"] = "Contactos";
        $dados["organizacao"] = Organizacao::all()->last();
        return view("site.pages.contacto",$dados);
    }

    public function store_inscrito(Request $request){
        $dados = $request->except('_token');

        if (Inscrito::where('email',"=",$dados['email'])->exists()) {
           return redirect()->back()->with("erro", "Já está inscrito para receber novidades");
        } else {
            Inscrito::create($dados);
            return redirect()->back()->with("sucesso", "Inscrito com sucesso");
        }
    }

    public function solicitar_servico(Request $request){
         //$request->dd();

        $dados = $request->except("_token");
        //dd($dados);
        //dd($dados);
        $validado = $request->validate([
                    'nome_completo' => 'required',
                    'email'         => 'required',
                    'servico_id'    => 'required',
                    'telefone'      => 'required',
                    'mensagem'      => 'required'
                ],[
                    'nome_completo.required' => 'Insira o nome completo',
                    'email.required'         => 'Insira o email',
                    'servico_id.required'    => 'Seleccione o serviço',
                    'telefone.required'      => 'Insira o telefone',
                    'mensagem.required'      => 'Insira a mensagem'
                ]);

        SolicitacaoServico::create($dados);
        return redirect()->back()->with("solicitacao_sucesso", "Enviado com sucesso");
    }


    public function  candidatar_se(Request $request){

        define("PASTA_CURRICULO","curriculos/");

        $dados  = [];

        $validado = $request->validate([
            'nome_completo' => 'required',
            'email'         => 'required',
            'area_id'       => 'required',
            'telefone'      => 'required',
            'resumo'        => 'required',
            'curriculo'     => 'required'
        ],[
            'nome_completo.required' => 'Insira o nome completo',
            'email.required'         => 'Insira o email',
            'area_id.required'       => 'Seleccione a area',
            'telefone.required'      => 'Insira o telefone',
            'resumo.required'        => 'Insira a resumo',
            'curriculo.required'     => 'Insira a curriculo'
        ]);

            if($request->curriculo){

                if($request->hasFile('curriculo') && $request->curriculo->isValid()){
                    $nome_curriculo = $request->file('curriculo')->hashName();
                    $curriculo_pdf  = $request->file("curriculo");

                    $curriculo_pdf->move(public_path(PASTA_CURRICULO), $nome_curriculo);

                    $dados["nome_completo"] = $request->nome_completo;
                    $dados["email"]         = $request->email;
                    $dados["telefone"]      = $request->telefone;
                    $dados["resumo"]        = $request->resumo;
                    $dados["area_id"]       = $request->area_id;
                    $dados["curriculo"]     = PASTA_CURRICULO . $nome_curriculo;

                    Candidato::create($dados);

                    return redirect()->back()->with("sucesso", "Curriculo enviado com sucesso ");
                }else{
                    $errorCode = $request->file('curriculo')->getError();

                    if ($errorCode == UPLOAD_ERR_INI_SIZE) {
                        return back()->with(['erro' => 'O curriculo é muito pesado. Tamanho máximo: ' . ini_get('upload_max_filesize')]);
                    } elseif ($errorCode == UPLOAD_ERR_NO_FILE) {
                        return back()->with(['erro' => 'Nenhum curriculo foi enviado.' ]);
                    } else {
                        return back()->with(['erro' => 'Falha ao enviar o curriculo.']);
                    }
                }

            }else{
                return redirect()->back()->with("erro", "Erro ao enviar o curriculo" );
            }

    }

    public function servico_email(Request $request)
    {
       // dd($request);

    	$details = [
    		'subject' => 'Test Notification'
    	];

        $job = (new \App\Jobs\SendQueueEmail($details))
            	->delay(now()->addSeconds(2));

        dispatch($job);
        return "Mail send successfully !!";
    }

}
