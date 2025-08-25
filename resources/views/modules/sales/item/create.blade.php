@extends('administracao.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Artigo /</span> Criar nova</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"></h5>
                    <a href="{{ route('sales.item.index') }}"><small class="text-muted float-end">Ver todas</small></a>
                </div>
                <div class="card-body">
                    @if (session('sucesso'))
                        <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('sucesso') }}.</div>
                    @endif

                    @if (session('erro'))
                        <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{ session('erro') }}.</div>
                    @endif
                    <form action="{{ route('sales.item.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="basic-default-fullname">Nome</label>
                                <input name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" id="basic-default-fullname"
                                    placeholder="" />
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label" for="basic-default-fullname">Preço</label>
                                <input name="price" type="number"
                                    class="form-control @error('price') is-invalid @enderror" id="basic-default-fullname"
                                    placeholder="" />
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label" for="basic-default-fullname">Taxa de imposto</label>
                                <input name="tax_rate" type="number"
                                    class="form-control @error('tax_rate') is-invalid @enderror" id="basic-default-fullname"
                                    placeholder="" />
                                @error('tax_rate')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label for="exampleFormControlSelect1" class="form-label">Tipo</label>
                                <select name="item_type" class="form-select @error('item_type') is-invalid @enderror"
                                    id="exampleFormControlSelect1" aria-label="Default select example">
                                    <option value="" selected disabled >Selecione</option>
                                    <option value="PRODUCT">Produto</option>
                                    <option value="SERVICE">Serviço</option>
                                </select>
                                @error('item_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-message">Descrição</label>
                            <textarea name="description" id="summernote" class="form-control  @error('description') is-invalid @enderror"
                                placeholder="Escreva ..."></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" style="background-color: #005657; border-color: #005657;"
                            class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
