@extends('site.master')
@section('content')

        <!-- Fact Start -->
        <div class="container-fluid bg-secondary py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".1s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value">98</h1>
                            <h5 class="text-white mt-1">% De Satisfação do Cliente</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".3s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value">+100</h1>
                            <h5 class="text-white mt-1">Projetos Implementados</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".5s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value">120</h1>
                            <h5 class="text-white mt-1">Clientes <br> satisfeitos</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".7s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value">+5</h1>
                            <h5 class="text-white mt-1">Parcerias <br> Estratégicas</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact End -->


        <!-- About Start -->
        <div class="container-fluid py-5 my-5">
            <div class="container pt-5">
                <div class="row g-5">
                    <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                        <div class="h-100 position-relative">
                            <img src="{{asset('assets/site/img/about-1.jpg')}}" class="img-fluid w-75 rounded" alt="" style="margin-bottom: 25%;">
                            <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                                <img src="{{asset('assets/site/img/about-2.jpg')}}" class="img-fluid w-100 rounded" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                        <h5 class="text-primary">Sobre</h5>
                        <h1 class="mb-4">Encane é um Software de Facturação, Simples e Eficaz.</h1>
                        <p class="mb-4">Desenvolvido para ser prático, e simples de usar.</p>
                        <a href="" class="btn btn-secondary rounded-pill px-5 py-3 text-white">Saber mais</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Services Start -->
        <div class="container-fluid services py-5 mb-5">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                    <h5 class="text-primary">Nossos Serviços</h5>
                    <h4>Descubra os nossos serviços que impulsionam a evolução tecnológica dos nossos clientes</h4>
                </div>
                <div class="row g-5 services-inner">
                   
                    <div class="col-md-12 col-lg-12 wow fadeIn" data-wow-delay=".5s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fa fa-chart-bar fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">Software de Gestão</h4>
                                    <p class="mb-4">Desenvolvemos soluções de software personalizadas para otimizar processos empresariais, simplificar a gestão e aumentar a eficiência operacional.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Services End -->



        <!-- Contact Start -->
        <div class="container-fluid py-5 mb-5">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                    <h5 class="text-primary">Fale conosco ou solicite um seviço</h5>
                    <h1 class="mb-3">Estamos aqui para atender você</h1>
                    <p class="mb-2">Entre em contato conosco para descobrir como a <span class="text-secondary">Encane</span>  pode impulsionar a sua jornada  emprendedora.</p>
                </div>
                <div class="contact-detail position-relative p-5">
                    <div class="row g-5 mb-5 justify-content-center">
                        <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".3s">
                            <div class="d-flex bg-light p-3 rounded">
                                <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="text-primary">Endereço</h4>
                                    <a href="https://goo.gl/maps/Zd4BCynmTb98ivUJ6" target="_blank" class="h6">{{$org_activa->endereco}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".5s">
                            <div class="d-flex bg-light p-3 rounded">
                                <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                                    <i class="fa fa-phone text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="text-primary">Contacto</h4>
                                    <a class="h6" href="tel:{{$org_activa->telefone_1}}" target="_blank">{{$org_activa->telefone_1}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".7s">
                            <div class="d-flex bg-light p-3 rounded">
                                <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                                    <i class="fa fa-envelope text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="text-primary">Email</h4>
                                    <a class="h6" href="mailto:{{$org_activa->email}}" target="_blank">{{$org_activa->email}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-5">
                        <div class="col-md-6 wow fadeIn" data-wow-delay=".3s">
                            <div class="p-5 h-100 rounded contact-map">
                                <iframe class="rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16041965.864065975!2d7.071800056176087!3d-11.00139585459055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a51f24ecaad8b27%3A0x590a289d0d4a4e3d!2sAngola!5e0!3m2!1spt-PT!2sao!4v1709798581990!5m2!1spt-PT!2sao"  width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-delay=".5s">
                            <form  action="{{route('solicitar_servico')}}" method="POST">
                                @csrf
                               
                                <div class="p-5 rounded contact-form">
                                    @if (session('solicitacao_sucesso'))
                                        <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('solicitacao_sucesso')}}.</div>
                                    @endif
                                    <div class="mb-4">
                                        <input name="nome_completo"  type="text" class="form-control border-0 py-3" placeholder="Nome completo">
                                        @error('nome_completo')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input type="email"  name="email" class="form-control border-0 py-3" placeholder="Email">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input type="tel" name="telefone" class="form-control border-0 py-3" placeholder="Telefone">
                                        @error('telefone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <select  name="servico_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                            <option value="" disabled selected>Serviço</option>
                                                @foreach ($servico_activos as $servico)
                                                    <option value="{{$servico->id}}">{{$servico->titulo}}</option>   
                                                @endforeach
                                            </select>
                                            @error('servico_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
    

                                    <div class="mb-4">
                                        <textarea name="mensagem" class="w-100 form-control border-0 py-3" rows="6" cols="10" placeholder="Escreva aqui ..."></textarea>
                                        @error('mensagem')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="text-start">
                                        <button class="btn bg-primary text-white py-3 px-5" type="submit">Enviar</button>
                                    </div>
                                </div>
                            </form>
                          
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- Contact End -->




@endsection
