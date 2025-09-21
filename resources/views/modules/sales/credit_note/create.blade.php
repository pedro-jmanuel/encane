@extends('administracao.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Nota de Crédito /</span> Criar</h4>

    <div class="row">

        <input type="hidden" name="sales_order_id" value="{{ $order->id }}">
        <div class="col-lg-12 col-sm-12 col-12">

            <div class="btn-group my-2" id="dropdown-icon-demo">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bx bx-menu"></i> Ações
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('sales.invoice.show', ['invoice' => $order->invoice->id]) }}">Visualizar
                            Factura</a>

                    </li>
                </ul>
            </div>

        </div>
        <h2 class="mb-4">Nota de Crédito, Factura #{{ $order->invoice->id }}</h2>
    </div>
    <div class="row">
        
        @if ($order->invoice->hasCreditNote())

            @if (session('sucesso'))
                <div class="alert alert-success"><i class="bi bi-check-circle"></i>
                    {{ session('sucesso') }}.
                </div>
            @endif

            @if (session('erro'))
                <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{ session('erro') }}.
                    </div>
                @endif
            <div class="alert alert-primary" role="alert">Já existe uma nota de crédito para esta factura.</div>
        @else
            <form action="{{ route('sales.credit_note.store', ['order' => $order->id, 'invoice' => $order->invoice->id]) }}"
                method="POST" enctype="multipart/form-data">

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
                                    data-bs-target="#navs-pills-justified-profile"
                                    aria-controls="navs-pills-justified-profile" aria-selected="false">
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
                                <div class="alert alert-success"><i class="bi bi-check-circle"></i>
                                    {{ session('sucesso') }}.
                                </div>
                            @endif

                            @if (session('erro'))
                                <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{ session('erro') }}.
                                </div>
                            @endif

                            @if ($order->hasInvoice())
                                <div class="alert alert-warning"><i class="bi bi-check-circle"></i> Este pedido já não pode
                                    ser
                                    alterado pois já foi criado uma factura.</div>
                            @endif

                            @error('sales_order_id')
                                <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{ $message }}</div>
                            @enderror
                            <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                                @if ($order->hasInvoice())
                                    <fieldset disabled>
                                    @else
                                        <fieldset>
                                @endif
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="name">Nome</label>
                                        <input name="name" type="text" value="{{ $order->customer->name }}"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="" />
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phone">Telefone</label>
                                        <input name="phone" type="text" value="{{ $order->customer->phone }}"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            placeholder="" />
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="tax_number">NIF</label>
                                        <input name="tax_number" type="text" value="{{ $order->customer->tax_number }}"
                                            class="form-control @error('tax_number') is-invalid @enderror" id="tax_number"
                                            placeholder="" />
                                        @error('tax_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="email">Email</label>
                                        <input name="email" type="text" value="{{ $order->customer->email }}"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            placeholder="" />
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="address">Endereço</label>
                                        <input name="address" type="text" value="{{ $order->customer->address }}"
                                            class="form-control @error('address') is-invalid @enderror" id="address"
                                            placeholder="" />
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">


                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="quantity">Data de Vencimento</label>
                                        <input name="due_date" type="date" min="1"
                                            value="{{ \Carbon\Carbon::parse($order->due_date)->format('Y-m-d') }}"
                                            class="form-control @error('due_date') is-invalid @enderror" id="due_date"
                                            placeholder="" />
                                        @error('due_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div id="app">
                                    <h4 class="fw-bold py-3 mb-2">Linhas de pedido</h4>
                                    <span class="text-primary">@{{ loadingOrders ? "Carregando linhas do pedido..." : "" }}</span>
                                    <div class="table-responsive">
                                        <table class="table table-sm align-middle table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Artigo</th>
                                                    <th style="width: 90px;">Qtd</th>
                                                    <th>Preço (Kz)</th>
                                                    <th>Imp. (%)</th>
                                                    <th>Subtotal (Kz)</th>
                                                    <th style="width: 100px;">Qtd Devo</th>
                                                    <th>Subtot. Devo (Kz)</th>
                                                    <th class="text-end">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(row, index) in rows" :key="row.id ?? index">
                                                    <!-- Artigo -->
                                                    <td>
                                                        <select :name="`order_items[${index}][sales_item_id]`"
                                                            v-model="row.sales_item_id" class="form-select form-select-sm"
                                                            @readonly(true)>
                                                            <option value="" disabled>
                                                                @{{ loadingItems ? "Carregando..." : "Selecione" }}
                                                            </option>
                                                            <option v-for="item in items" :key="item.id"
                                                                :value="item.id">
                                                                @{{ item.name }}
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <!-- Quantidade -->
                                                    <td>
                                                        <input type="number" min="1"
                                                            class="form-control form-control-sm"
                                                            v-model.number="row.quantity"
                                                            :name="`order_items[${index}][quantity]`"
                                                            @disabled(true)>
                                                    </td>

                                                    <!-- Preço Unitário -->
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm "
                                                            v-model.number="row.unit_price"
                                                            :name="`order_items[${index}][unit_price]`" readonly>
                                                    </td>

                                                    <!-- Imposto -->
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm "
                                                            v-model.number="row.sales_tax"
                                                            :name="`order_items[${index}][sales_tax]`" readonly>
                                                    </td>

                                                    <!-- Subtotal -->
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm "
                                                            :value="calcSubtotal(row)"
                                                            :name="`order_items[${index}][subtotal]`"
                                                            @disabled(true)>
                                                    </td>

                                                    <!-- Quantidade Devolução -->
                                                    <td>
                                                        <input type="number" min="0" :max="row.quantity"
                                                            class="form-control form-control-sm"
                                                            v-model.number="row.return_quantity"
                                                            :name="`order_items[${index}][return_quantity]`">
                                                    </td>

                                                    <!-- Subtotal Devolução -->
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm "
                                                            :value="calcReturnSubtotal(row)"
                                                            :name="`order_items[${index}][return_subtotal]`" readonly>
                                                    </td>

                                                    <!-- Remover -->
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            @disabled(true)
                                                            v-on:click="removeRow(index,row.id)">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>




                                    <!-- Botão para adicionar linhas -->
                                    <button type="button" class="btn btn-primary" v-on:click="addRow"
                                        @disabled(true)>
                                        + Adicionar Linha
                                    </button>

                                    <!-- Total Geral -->
                                    <div class="alert alert-info fw-bold my-4">
                                        Total Geral: <span v-text="totalGeral"></span> Kz
                                    </div>
                                    <!-- Total Geral -->
                                    <div class="alert alert-info fw-bold my-4">
                                        Total Geral Devolução: <span v-text="returnTotalGeral"></span> Kz
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="status" class="form-label">Salvar pedido como?</label>
                                        <select @disabled(true) name="status"
                                            class="form-select @error('status') is-invalid @enderror" id="status"
                                            aria-label="Default select example">
                                            <option value="" selected disabled>Selecione</option>
                                            @foreach ($order_status as $status)
                                                <option value="{{ $status['value'] }}"
                                                    @if ($status['value'] == $order->status) @selected(true) @endif>
                                                    {{ $status['label'] }}</option>
                                            @endforeach

                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="reason" class="form-label">Motivo</label>
                                        <input type="text" id="reason" class="form-control" name="reason">
                                    </div>
                                    <button type="submit" style="background-color: #005657; border-color: #005657;"
                                        class="btn btn-primary">Salvar</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </form>
        @endif

    </div>

    <!-- Vue -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        window.showToast = function(message, type = "success") {
            // Cria o container se ainda não existir
            let container = document.getElementById("toast-container");
            if (!container) {
                container = document.createElement("div");
                container.id = "toast-container";
                container.className = "toast-container position-fixed top-0 end-0 p-3";
                // 🔥 Garante que fica sempre por cima
                container.style.zIndex = "2147483647";
                container.style.pointerEvents = "none";
                document.body.appendChild(container);

            }

            // Monta o toast
            const toast = document.createElement("div");
            toast.className = `toast align-items-center bg-${type} border-0`;
            toast.setAttribute("role", "alert");
            toast.setAttribute("aria-live", "assertive");
            toast.setAttribute("aria-atomic", "true");
            toast.innerHTML = `
            <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;

            container.appendChild(toast);

            // Inicializa e mostra
            const bsToast = new bootstrap.Toast(toast, {
                delay: 3000
            });
            bsToast.show();

            // Remove depois de desaparecer
            toast.addEventListener("hidden.bs.toast", () => toast.remove());
        }
    </script>
    <script>
        const {
            createApp
        } = Vue;

        createApp({
            data() {
                return {
                    loadingItems: true,
                    loadingOrders: true,
                    order: {{ $order->id }},
                    items: [],
                    rows: [{
                        id: 0,
                        sales_item_id: '',
                        quantity: 1,
                        unit_price: 0,
                        discount: 0,
                        sales_tax: 0,
                        return_quantity: 0,
                        return_subtotal: 0
                    }]
                };
            },
            mounted() {
                this.fetchItems();
                this.fetchOrders();
            },
            methods: {
                async fetchItems() {
                    try {
                        this.loadingItems = true;
                        const baseUrl = window.location.origin;
                        const res = await fetch(`${baseUrl}/api/sales/item`);
                        const data = await res.json();
                        this.items = data;
                    } catch (err) {
                        console.error("Erro ao carregar artigos", err);
                    } finally {
                        this.loadingItems = false;
                    }
                },
                async fetchOrders() {
                    try {
                        this.loadingOrders = true;
                        const baseUrl = window.location.origin;
                        const res = await fetch(`${baseUrl}/api/sales/order/${this.order}/items`);
                        const data = await res.json();
                        this.rows = data;
                    } catch (err) {
                        console.error("Erro ao carregar linhas do pedido", err);
                    } finally {
                        this.loadingOrders = false;
                    }
                },

                addRow() {
                    this.rows.push({
                        id: undefined,
                        sales_item_id: "",
                        quantity: 1,
                        unit_price: 0,
                        sales_tax: 0,
                        discount: 0,
                        return_quantity: 0,
                        return_subtotal: 0
                    });

                },
                removeRow(index, rowId) {

                    this.rows.splice(index, 1);
                    return;
                },

                calcSubtotal(row) {
                    let item = this.items.find(i => i.id === row.sales_item_id);
                    if (item) {
                        row.unit_price = item.price;
                        row.sales_tax = item.sales_tax;
                    }
                    let base = (row.quantity * row.unit_price) - row.discount;
                    let tax = base * (row.sales_tax / 100);
                    return base + tax;
                },
                calcReturnSubtotal(row) {
                    if (!row.return_quantity || row.return_quantity <= 0) {
                        return 0;
                    }

                    const qty = Number(row.return_quantity) || 0;
                    const price = Number(row.unit_price) || 0;
                    const tax = Number(row.sales_tax) || 0;

                    // Subtotal sem imposto
                    let subtotal = qty * price;

                    // Aplica imposto se existir
                    if (tax > 0) {
                        subtotal += subtotal * (tax / 100);
                    }
                    return subtotal;
                }
            },
            computed: {
                totalGeral() {
                    return this.rows.reduce((acc, row) => acc + this.calcSubtotal(row), 0).toFixed(2);
                },
                returnTotalGeral() {
                    return this.rows.reduce((total, row) => total + this.calcReturnSubtotal(row), 0).toFixed(2);
                }
            }
        }).mount("#app");
    </script>
@endsection
