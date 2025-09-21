<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura {{ $invoice->id }}</title>
    <style>
        body{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 10pt;
        }
        @page {
            size: letter potrait;
            margin: 1cm;
        }

        .tabela {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .thead_tr_tabela{
            border: 1px solid black;
            margin: 0px;
            padding: 0px;
        }
        .thead_th_tabela{
            border: 1px solid black;
            margin: 0px;
            padding: 0px;
        }

        .tr_tabela{
           
            text-align: left;
            margin: 0px;
            padding: 0px;
        }

        .td_tabela {
            border: 1px solid black;
            text-align: left;
            margin: -1px;
            padding: 2px;
        }
        .page-num{
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    {{$org_activa->nome}}

    <h1>Nota de Crédito</h1>
    <br>
    {{--
        <h6>Nome Cliente: {{ $invoice->order->customer->name }}</h6>
        <h6>E-mail: {{ $invoice->order->customer->email }}</h6>
        <h6>NIF: {{$invoice->order->customer->tax_number}}</h6>
        <h6>Telefone: {{$invoice->order->customer->phone}}</h6>

    --}}

    <table class="tabela" style="width: 100%">
        <thead>
            <tr class="thead_tr_tabela" style="padding-top: 3px;">
                <th style="width: 5%;">#</th>
                <th style="width: 45%;">Artigo</th>
                <th style="width: 5%;">Qtd</th>
                <th style="width: 15%;">Preço Unit.</th> 
                <th style="width: 15%;">Valor Imp.</th>
                <th style="width: 15%;">Imposto</th>
                <th style="width: 15%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($credit_note->creditNoteItems as $creditNoteItem)
                <tr class="tr_tabela">
                        <td class="td_tabela"  style="text-align: right;">{{ ($loop->index + 1) }}</td>
                        <td class="td_tabela">{{ $creditNoteItem->item->name }} </td>
                        <td class="td_tabela" style="text-align: right;">{{ $creditNoteItem->quantity}} </td>
                        <td class="td_tabela" style="text-align: right;">{{ number_format($creditNoteItem->unit_price, 2, ',', '.') }}Kz</td>
                        <td class="td_tabela" style="text-align: right;">{{ number_format(($creditNoteItem->unit_price * $creditNoteItem->quantity) * ($creditNoteItem->sales_tax / 100), 2, ',', '.') }}kz</td>
                        <td class="td_tabela" style="text-align: right;">{{ number_format($creditNoteItem->sales_tax, 2, ',', '.')  }}%</td>
                        <td class="td_tabela" style="text-align: right;">{{ number_format($creditNoteItem->subtotal, 2, ',', '.') }}Kz</td>
                </tr>
            @endforeach
        </tbody>
    </table>
       <br>
       <br>
    <div>Total a Pagar: {{ number_format($credit_note->total_amount, 2, ',', '.') }}Kz </div>
</body>

</html>
