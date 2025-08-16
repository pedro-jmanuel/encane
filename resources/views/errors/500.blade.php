@extends('site.master')
@section('content')

<section id="main-container" class="main-container">
    <div class="container">

      <div class="row">

        <div class="col-12">
          <div class="error-page text-center">
            <div class="error-code">
              <h2><strong>500</strong></h2>
            </div>
            <div class="error-message">
              <h3>Oops ... Algo ocorreu mal no servidor !</h3>
            </div>
            <div class="error-body">
              <br>
              <a href="{{route('index')}}" class="btn btn-primary">IR PARA INÍCIO</a>
            </div>
          </div>
        </div>

      </div><!-- Content row -->
    </div><!-- Conatiner end -->
  </section><!-- Main container end -->

@endsection
