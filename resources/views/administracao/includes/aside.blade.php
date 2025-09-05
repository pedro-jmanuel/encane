<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{route('home')}}" class="app-brand-link my-2">
        {{-- <span class="app-brand-logo demo"> --}}
         <img  style="width: 80%;height: 80%;" src="{{asset('assets/administracao/logo.jpg')}}"  alt="" srcset="">
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item {{ Route::is('home') ? 'active' : '' }}">
        <a href="{{route('home')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Início</div>
        </a>
      </li>
      {{-- 
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Elements">Notícias</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('noticia/create') ? 'active' : '' }}">
            <a href="{{route('noticia.create')}}"  class="menu-link">
              <div data-i18n="Basic Inputs">Publicar nova</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('noticia/index') ? 'active' : '' }}">
            <a href="{{route('noticia.index')}}" class="menu-link">
              <div data-i18n="Input groups">Ver todas</div>
            </a>
          </li>
        </ul>
      </li>

      --}}
      {{-- <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Misc">Associados</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{route('parceiro.create')}}" class="menu-link">
              <div data-i18n="Error">Registrar novo</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{route('parceiro.index')}}" class="menu-link">
              <div data-i18n="Under Maintenance">Ver todos</div>
            </a>
          </li>
        </ul>
      </li> 
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="User interface">Serviços</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{route('servico.create')}}" class="menu-link">
              <div data-i18n="Accordion">Criar novo</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{route('servico.index')}}" class="menu-link">
              <div data-i18n="List Groups">Ver todos</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{route('servico.solicitacoes')}}" class="menu-link">
              <div data-i18n="List Groups">Solicitações
                @if ($qtd_solicitacao_pendente > 0)
                    <span class="badge badge-center rounded-pill bg-warning">{{$qtd_solicitacao_pendente}}</span>
                @endif
            </div>
            </a>
          </li>
        </ul>
      </li>
      --}}
      {{-- <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-support"></i>
            <div data-i18n="Support">Utilizador</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="" class="menu-link">
              <div data-i18n="Accordion">Criar conta</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="" class="menu-link">
              <div data-i18n="List Groups">Ver todos</div>
            </a>
          </li>

        </ul>
      </li> --}}
      <li class="menu-item {{ Route::is('organizacao.*') ? 'active open' : '' }}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cube"></i>
          <div data-i18n="User interface">Organização</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Route::is('organizacao.create') ? 'active' : '' }}">
            <a href="{{route("organizacao.create")}}" class="menu-link">
              <div data-i18n="Accordion">Criar nova</div>
            </a>
          </li>

          <li class="menu-item {{ Route::is('organizacao.index') ? 'active' : '' }}">
            <a href="{{route("organizacao.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver todos</div>
            </a>
          </li>

        </ul>
      </li>
      {{--
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="User interface">Plano</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{route("plano.create")}}" class="menu-link">
              <div data-i18n="Accordion">Criar novo</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{route("plano.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver todos</div>
            </a>
          </li>

        </ul>
      </li> 

      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="User interface">Equipe</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{route("membro.create")}}" class="menu-link">
              <div data-i18n="Accordion">Novo membro</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{route("membro.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver membros</div>
            </a>
          </li>

        </ul>
      </li> 

      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="User interface">Recrutamento</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{route("area.create")}}" class="menu-link">
              <div data-i18n="Accordion">Criar área</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{route("area.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver todas área</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{route("candidato.index")}}" class="menu-link">
              <div data-i18n="List Groups">Candidatos</div>
            </a>
          </li>

        </ul>
      </li> --}}

      <li class="menu-item {{ Route::is('inscrito.*') ? 'active open' : '' }}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-receipt"></i>
          <div data-i18n="User interface">Newsletter</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Route::is('inscrito.index') ? 'active' : '' }}">
            <a href="{{route("inscrito.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver todos</div>
            </a>
          </li>

        </ul>
      </li>
      <li class="menu-item {{ Route::is('pagina.*') ? 'active open' : '' }}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx  bxs-layout"></i>
          <div data-i18n="User interface">Pagínas</div>
        </a>
        <ul class="menu-sub">

          <li class="menu-item {{ Route::is('pagina.index') ? 'active' : '' }}">
            <a href="{{route("pagina.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver todas</div>
            </a>
          </li>

        </ul>
      </li>
      <li class="menu-item {{ Route::is('sales.category.*') ? 'active open' : '' }}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx  bx-tag"></i>
          <div data-i18n="User interface">Categoria</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Route::is('sales.category.create') ? 'active' : '' }}">
            <a href="{{route("sales.category.create")}}" class="menu-link ">
              <div data-i18n="Accordion">Criar nova</div>
            </a>
          </li>

          <li class="menu-item {{ Route::is('sales.category.index') ? 'active' : '' }}">
            <a href="{{route("sales.category.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver todos</div>
            </a>
          </li>

        </ul>
      </li>

      <li class="menu-item {{ Route::is('sales.item.*') ? 'active open' : '' }}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx  bx-package"></i>
          <div data-i18n="User interface">Artigo</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Route::is('sales.item.create') ? 'active' : '' }}">
            <a href="{{route("sales.item.create")}}" class="menu-link">
              <div data-i18n="Accordion">Criar novo</div>
            </a>
          </li>

          <li class="menu-item {{ Route::is('sales.item.index') ? 'active' : '' }}">
            <a href="{{route("sales.item.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver todos</div>
            </a>
          </li>

        </ul>
      </li>

      <li class="menu-item {{ Route::is('sales.order.*') ? 'active open' : '' }}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx  bx-cart"></i>
          <div data-i18n="User interface">Pedido</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Route::is('sales.order.create') ? 'active' : '' }}">
            <a href="{{route("sales.order.create")}}" class="menu-link">
              <div data-i18n="Accordion">Criar novo</div>
            </a>
          </li>

          <li class="menu-item {{ Route::is('sales.order.index') ? 'active' : '' }}">
            <a href="{{route("sales.order.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver todos</div>
            </a>
          </li>

        </ul>
      </li>
      <li class="menu-item {{ Route::is('sales.invoice.*') ? 'active open' : '' }}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx  bx-receipt"></i>
          <div data-i18n="User interface">Factura</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Route::is('sales.invoice.index') ? 'active' : '' }}">
            <a href="{{route("sales.invoice.index")}}" class="menu-link">
              <div data-i18n="List Groups">Ver todos</div>
            </a>
          </li>

        </ul>
      </li>
    </ul>
  </aside>
