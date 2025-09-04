@extends('administracao.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pedidos /</span> Criar novo</h4>
    <div class="row">
        <form action="{{ route('sales.order.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-xl-12 col-xl-12">

                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                                aria-selected="true">
                                <i class="tf-icons bx bx-user-circle"></i> Dados do Cliente
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                                aria-selected="false">
                                <i class="tf-icons bx bx-cart"></i> Dados do Pedido
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-justified-messages"
                                aria-controls="navs-pills-justified-messages" aria-selected="false">
                                <i class="tf-icons bx bx-check-circle"></i> Finalizar Pedido
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        @if (session('sucesso'))
                            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('sucesso') }}.
                            </div>
                        @endif

                        @if (session('erro'))
                            <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{ session('erro') }}.</div>
                        @endif


                        <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">Nome</label>
                                    <input name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="" />
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Telefone</label>
                                    <input name="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        placeholder="" />
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="tax_number">NIF</label>
                                    <input name="tax_number" type="text"
                                        class="form-control @error('tax_number') is-invalid @enderror" id="tax_number"
                                        placeholder="" />
                                    @error('tax_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="tax_number">Email</label>
                                    <input name="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="" />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="address">Endereço</label>
                                    <input name="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" id="address"
                                        placeholder="" />
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">


                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="quantity">Data de Vencimento</label>
                                    <input name="due_date" type="date" min="0"
                                        class="form-control @error('due_date') is-invalid @enderror" id="due_date"
                                        placeholder="" />
                                    @error('due_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div id="app">
                                <h4 class="fw-bold py-3 mb-2">Linhas de pedido</h4>

                                <div v-for="(row, index) in rows" :key="index" class="row mb-3">
                                    <!-- Artigo -->
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Artigo N: @{{ index }} </label>
                                        <select :name="`order_items[${index}][sales_item_id]`" class="form-select"
                                            v-model="row.sales_item_id" v-on:change="setPrice(row)">
                                            <option value="" disabled selected>Selecione</option>
                                            <option v-for="i in items" :key="i.id" :value="i.id">
                                                @{{ i.name }}
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Quantidade -->
                                    <div class="mb-3 col-md-2">
                                        <label class="form-label">Quantidade</label>
                                        <input type="number" min="1" class="form-control"
                                            v-model.number="row.quantity" :name="`order_items[${index}][quantity]`">
                                    </div>

                                    <!-- Preço Unitário (readonly) -->
                                    <div class="mb-3 col-md-2">
                                        <label class="form-label">Preço Unitário <small>(Kz)</small></label>
                                        <input type="number" class="form-control" readonly
                                            v-model.number="row.unit_price" :name="`order_items[${index}][unit_price]`">
                                    </div>

                                    <!-- Desconto -->
                                    <div class="mb-3 col-md-2">
                                        <label class="form-label">Desconto <small>(Kz)</small></label>
                                        <input type="number" min="0" class="form-control"
                                            v-model.number="row.discount" :name="`order_items[${index}][discount]`">
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="mb-3 col-md-2">
                                        <label class="form-label">Subtotal <small>(Kz)</small></label>
                                        <input type="number" class="form-control" readonly :value="calcSubtotal(row)"
                                            :name="`order_items[${index}][subtotal]`">
                                    </div>
                                </div>

                                <!-- Botão para adicionar linhas -->
                                <button type="button" class="btn btn-primary" v-on:click="addRow">
                                    + Adicionar Linha
                                </button>

                                <!-- Total Geral -->
                                <div class="alert alert-info fw-bold my-4">
                                    Total Geral: <span v-text="totalGeral"></span> Kz
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="status" class="form-label">Salvar pedido como?</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror"
                                        id="status" aria-label="Default select example">
                                        <option value="" selected disabled>Selecione</option>
                                        @foreach ($order_status as $status)
                                            <option value="{{ $status['value'] }}">{{ $status['label'] }}</option>
                                        @endforeach

                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" style="background-color: #005657; border-color: #005657;"
                                    class="btn btn-primary">Salvar</button>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </form>
    </div>

    <!-- Vue -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        const {
            createApp
        } = Vue;

        createApp({
            data() {
                return {
                    items: [],
                    rows: [{
                        sales_item_id: '',
                        quantity: 1,
                        unit_price: 0,
                        discount: 0
                    }]
                };
            },
            mounted() {

                const baseUrl = window.location.origin;
                fetch(baseUrl + '/api/sales/item')
                    .then(response => response.json())
                    .then(data => {
                        this.items = data;
                        console.log();
                    })
                    .catch(error => console.error('Erro ao carregar itens:', error));
            },
            methods: {
                addRow() {
                    this.rows.push({
                        sales_item_id: '',
                        quantity: 1,
                        unit_price: 0,
                        discount: 0
                    });
                },
                setPrice(row) {
                    const item = this.items.find(i => i.id == row.sales_item_id);
                    row.unit_price = item ? item.price : 0;
                },
                calcSubtotal(row) {
                    return (row.quantity * row.unit_price) - row.discount;
                }
            },
            computed: {
                totalGeral() {
                    return this.rows.reduce((acc, row) => acc + this.calcSubtotal(row), 0);
                }
            }
        }).mount("#app");
    </script>
    </script>
@endsection
