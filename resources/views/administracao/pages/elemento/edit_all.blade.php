@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> <a href="{{route('pagina.index')}}">Ver todas pagínas</a> / Editar elementos da pagína : </span>{{$pagina->nome}}</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                @if (session('sucesso'))
                    <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
                @endif

                @if (session('erro'))
                    <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
                @endif


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


@foreach ($elementos as $elemento)

    <div class="modal fade" id="exLargeModal-{{$elemento->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel4">Ver imagem</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <img loading="lazy" src="{{asset($elemento->imagem)}}" class="img-fluid" alt="imagem">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Fechar
            </button>
            </div>
        </div>
        </div>
    </div>



    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Elemento ( {{$loop->index + 1}} ) </h5>

            </div>
            <div class="card-body">

                <form action="{{route('elemento.update',["id"=> $elemento->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Título</label>
                                <input value="{{$elemento->titulo}}"  name="titulo" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">
                                    <button
                                    type="button"
                                    class="btn btn-xs btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exLargeModal-{{$elemento->id}}"
                                    >
                                        Ver
                                    </button>
                                    &nbsp; Imagem
                                </label>
                                <input name="imagem" class="form-control" type="file" id="formFile" />
                            </div>

                        </div>
                    </div>


                <div class="mb-3">
                    <label class="form-label" for="basic-default-message">Conteúdo</label>
                    <textarea
                    name="conteudo"
                    id="summernote_not"
                    class="form-control"
                    placeholder="Escreva ..."
                    >{!! $elemento->conteudo !!}</textarea>
                </div>
                <button type="submit" style="background-color: #005657; border-color: #005657;" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
            </div>
        </div>
    </div>


@endforeach

@endsection
