@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Membro /</span> Publicar novo</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Membro</h5>
        <a href="{{route('membro.index')}}"><small class="text-muted float-end">Ver todos</small></a>
      </div>
      <div class="card-body">
        @if (session('sucesso'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
        @endif
        <form action="{{route('membro.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nome completo</label>
                        <input name="nome_completo" type="text" class="form-control @error('nome_completo') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('nome_completo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Cargo</label>
                        <input name="cargo" type="text" class="form-control @error('cargo') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('cargo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto profissional</label>
                        <input name="imagem" class="form-control @error('imagem') is-invalid @enderror" type="file" id="formFile" />
                        @error('imagem')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Linkedin</label>
                        <input name="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('linkedin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Facebook</label>
                        <input name="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('facebook')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Instagram</label>
                        <input name="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('instagram')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Twitter</label>
                        <input name="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('twitter')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
            </div>

          <button type="submit" style="background-color: #005657; border-color: #005657;" class="btn btn-primary">Publicar</button>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection
