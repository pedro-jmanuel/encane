<?php

namespace App\Http\Controllers\Modules\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sales\Customer;
use App\Models\Sales\Item;
use App\Models\Sales\Order;
use App\Models\Sales\OrderItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public $order_status = [
        [
            'label' =>'Rascunho',
            'value' =>'DRAFT',
            'help'  =>'Pedido ainda não confirmado',
            'span_class' =>'badge bg-secondary'
        ],
        [
            'label' =>'Pendente',
            'value' =>'PENDING',
            'help'  =>'Confirmado, aguardando emissão de fatura',
            'span_class' =>'badge bg-warning'
        ],
        [
            'label' =>'Cancelado',
            'value' =>'CANCELLED',
            'help'  =>'Pedido anulado',
            'span_class' =>'badge bg-danger'
        ],
        [
            'label' =>'Completo',
            'value' =>'COMPLETED',
            'help'  =>'Pedido finalizado (entregue)',
            'span_class' =>'badge bg-success'
        ]
    ];

  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["orders"] = Order::paginate(10);
        $data["order_status"] = $this->order_status;
        return view("modules.sales.order.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['items'] = Item::all();
        $data['order_status'] = new Collection($this->order_status);
        
        return view("modules.sales.order.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //$request->dd();
        
        try {
            
            DB::beginTransaction();
            
            $customer['name']       = $request->name;
            $customer['email']      = $request->email;
            $customer['phone']      = $request->phone;
            $customer['address']    = $request->address;
            $customer['tax_number'] = $request->tax_number;

            $customerCreated = Customer::create($customer);

            $order['sales_customer_id'] = $customerCreated->id;
            $order['order_date']        = Carbon::now();
            $order['due_date']          = $request->due_date;
            $order['status']            = $request->status;
            $order['total_amount']      = 0;

            $orderCreated = Order::create($order);

            $orderItems  = [];
            $total_amount = 0;

            
            foreach ($request->order_items as $key => $order_item) {
                $orderLine['sales_order_id'] = $orderCreated->id;
                $orderLine['sales_item_id']    = $order_item['sales_item_id'];
                $orderLine['quantity']   = $order_item['quantity'];
                $orderLine['unit_price'] = $order_item['unit_price'];
                $orderLine['subtotal']   = $order_item['subtotal'];
                $orderLine['sales_tax']  = $order_item['sales_tax'];
                $orderLine['created_at'] = Carbon::now();
                $orderLine['updated_at'] = Carbon::now();
                $total_amount += $orderLine['subtotal'] ;
                array_push($orderItems,$orderLine);
            }
            $orderCreated->total_amount = $total_amount;
            $orderCreated->save();
            
            OrderItem::insert($orderItems);
            DB::commit(); 
            return redirect()->back()->with("sucesso", "Pedido salvo com sucesso ");
        } catch (\Exception $e) {
            DB::rollBack(); 
            throw $e;
            return redirect()->back()->with("erro", "Ocorreu algum erro ao salvar o pedido.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['order'] = Order::find($id);
        $data['order_status'] = new Collection($this->order_status);
        
        if ($data['order'] == NULL)
            return view('errors.404');

        return view("modules.sales.order.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->dd();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
