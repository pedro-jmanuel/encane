@extends('site.master')
@section('content')

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

@endsection
