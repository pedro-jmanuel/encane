@extends('administracao.master')
@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Definições /</span> Conta</h4>

      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Conta</a>
            </li>
          </ul>
          <div class="card mb-4">
            <h5 class="card-header"></h5>
            <!-- Account -->
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                  src="{{asset($user->imagem)}}"
                  alt="user-avatar"
                  class="d-block rounded"
                  height="100"
                  width="100"
                  id="uploadedAvatar"
                />
                <form action="{{route('user.nova_foto',["id" => auth()->user()->id ])}}" enctype="multipart/form-data" method="post" >
                    @csrf
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                          <span class="d-none d-sm-block">Nova foto</span>
                          <i class="bx bx-upload d-block d-sm-none"></i>
                          <input
                            type="file"
                            id="upload"
                            class="account-file-input"
                            hidden
                            name="imagem"
                            accept="image/png, image/jpeg"
                          />
                        </label>
                        <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4">
                          <i class="bx bx-reset d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">Atualizar</span>
                        </button>

                        {{-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> --}}
                      </div>
                </form>
              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
              <h4>Alterar dados</h4>
              <form id="formAccountSettings" action="{{route('user.update',["id" => auth()->user()->id ])}}" method="POST">
                @csrf
                @if (session('sucesso'))
                    <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
                @endif

                @if (session('erro'))
                    <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
                @endif
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Nome</label>
                    <input
                      class="form-control"
                      type="text"
                      id="firstName"
                      name="nome"
                      value="{{$user->nome}}"
                      autofocus
                    />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="lastName" class="form-label">Sobrenome</label>
                    <input class="form-control" type="text" name="sobrenome" id="lastName" value="{{$user->sobrenome}}" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input
                      class="form-control"
                      type="text"
                      id="email"
                      name="email"
                      value="{{$user->email}}"
                      placeholder=""
                    />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="organization" class="form-label">Nome de utilizador</label>
                    <input
                      type="text"
                      class="form-control"
                      id="organization"
                      name="name"
                      value="{{$user->name}}"
                    />
                  </div>

                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Salvar</button>
                </div>
              </form>
            </div>

            <div class="card-body">
                <h4>Alterar senha</h4>
                <br>
                <form id="formAccountSettings" action="{{route('user.nova_senha',['id' => auth()->user()->id ])}}" method="POST" >
                    @csrf
                    <div class="row">
                    <div class="mb-3 col-md-6">
                      <label for="firstName" class="form-label">Senha antiga</label>
                      <input
                        class="form-control"
                        type="password"
                        id="firstName"
                        name="senha_antiga"
                        value=""
                        autofocus
                      />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="lastName" class="form-label">Senha nova</label>
                      <input class="form-control" type="password" name="senha_nova" id="lastName" value="" />
                    </div>

                  </div>
                  <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                  </div>
                </form>
              </div>
            <!-- /Account -->
          </div>

        </div>
      </div>
    </div>
    <!-- / Content -->

@endsection
