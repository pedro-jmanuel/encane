@extends('administracao.master')
@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Artigo</h5>
                    <a href="{{ route('sales.item.index') }}"><small class="text-muted float-end">Ver todas</small></a>
                </div>
                <div class="card-body">
                    @if (session('sucesso'))
                        <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('sucesso') }}.</div>
                    @endif

                    @if (session('erro'))
                        <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{ session('erro') }}.</div>
                    @endif
                    <form action="{{ route('sales.item.update', ['item' => $item->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="name">Nome</label>
                                <input name="name" type="text" value="{{$item->name}}"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="" />
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="price">Preço</label>
                                <input name="price" value="{{$item->price}}" type="number"
                                    class="form-control  @error('price') is-invalid @enderror" id="price"
                                    placeholder="" />
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="tax_rate">Taxa de imposto</label>
                                <input name="tax_rate" value="{{$item->tax_rate}}" type="number"
                                    class="form-control @error('tax_rate') is-invalid @enderror" id="tax_rate"
                                    placeholder="" />
                                @error('tax_rate')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="item_type" class="form-label">Tipo</label>
                                <select name="item_type" class="form-select @error('item_type') is-invalid @enderror"
                                    id="item_type" aria-label="Default select example">
                                    <option value="" disabled>Selecione</option>
                                    <option value="PRODUCT" @if ($item->item_type == "PRODUCT") selected @endif>Produto</option>
                                    <option value="SERVICE" @if ($item->item_type == "SERVICE") selected @endif>Serviço</option>
                                </select>
                                @error('item_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="category_id" class="form-label">Categoria</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                    id="category_id" aria-label="Default select example">
                                    <option value="" selected disabled >Selecione</option>
                                    @foreach ($categories as $category)
                                        <option @if ($category->id == $item->category_id)
                                            selected
                                        @endif value="{{$category->id}}">{{$category->name}}</option>     
                                    @endforeach                     
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="summernote">Descrição</label>
                            <textarea name="description" id="summernote" class="form-control  @error('description') is-invalid @enderror"
                                placeholder="Escreva ...">{!! $item->description !!}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" style="background-color: #005657; border-color: #005657;"
                            class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
