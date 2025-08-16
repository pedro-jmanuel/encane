 <!-- Navbar Start -->
 <div class="container-fluid bg-primary">
    <div class="container">
        <nav class="navbar navbar-dark navbar-expand-lg py-0">
            <a href="index.html" class="navbar-brand">
                <h1 class="text-white fw-bold d-block">Encane<span class="text-secondary"></span> </h1>
            </a>
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                <div class="navbar-nav ms-auto mx-xl-auto p-0">
                    <a href="{{route('index')}}" class="nav-item nav-link @if(request()->is('/')) active text-secondary @endif">Início</a>
                    <a href="{{route('sobre')}}" class="nav-item nav-link @if(request()->is('sobre')) active text-secondary @endif ">Sobre</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Serviços</a>
                        <div class="dropdown-menu rounded">

                            @forelse ($servico_activos as $servico)
                                <a href="{{route('servico',$servico->slug)}}" class="dropdown-item @if(request()->is('servico/' . $servico->slug)) active text-secondary @endif">{{$servico->titulo}}</a>
                            @empty
                                <a href="#" class="dropdown-item">Sem serviços registrado</a>
                            @endforelse

                        </div>
                    </div>
                    <a href="{{route('contacto')}}" class="nav-item nav-link @if(request()->is('contacto')) active text-secondary @endif ">Contacto</a>
                </div>
            </div>
            <div class="d-none d-xl-flex flex-shirink-0">
                <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                    <a href="" class="position-relative animated tada infinite">
                        <i class="fa fa-phone-alt text-white fa-2x"></i>
                        <div class="position-absolute" style="top: -7px; left: 20px;">
                            <span><i class="fa fa-comment-dots text-secondary"></i></span>
                        </div>
                    </a>
                </div>
                <div class="d-flex flex-column pe-4 border-end">
                    <span class="text-white-50">Alguma pergunta?</span>
                    <span class="text-secondary">Ligue: {{$org_activa->telefone_1}}</span>
                </div>
                <div class="d-flex align-items-center justify-content-center ms-4 ">
                    <a href="#"><i class="bi bi-search text-white fa-2x"></i> </a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->