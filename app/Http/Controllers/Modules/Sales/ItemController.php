<?php

namespace App\Http\Controllers\Modules\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\Sales\Item\StoreItemRequest;
use App\Http\Requests\Modules\Sales\Item\UpdateItemRequest;
use App\Models\Sales\Category;
use App\Models\Sales\Item;
use App\Models\Sales\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data["items"] = Item::paginate(10);
        return view("modules.sales.item.index",$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["categories"] = Category::all();
        $data["taxes"] = Tax::all();
        return view("modules.sales.item.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(StoreItemRequest $request)
    public function store(StoreItemRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except("_token");
            $item = Item::create($data);

            $purchase_tax = Tax::find($request->purchase_tax_id);
            $sales_tax    = Tax::find($request->sales_tax_id);

            $item->purchase_tax_amount = $purchase_tax->amount;
            $item->purchase_tax_type   = $purchase_tax->type;
            $item->purchase_tax_code   = $purchase_tax->code;
            $item->purchase_tax        = $purchase_tax->percentage;

            $item->sales_tax_amount = $sales_tax->amount;
            $item->sales_tax_type   = $sales_tax->type;
            $item->sales_tax_code   = $sales_tax->code;
            $item->sales_tax        = $sales_tax->percentage;
            $item->save();

            DB::commit();
            return redirect()->back()->with("sucesso", "Artigo salvo com sucesso ");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return redirect()->back()->with("erro", "Ocorreu algum erro ao salvar o artigo.");
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
        $data['item'] = Item::find($id);
        $data["categories"] = Category::all();
        $data["taxes"] = Tax::all();

        if ($data['item'] == NULL)
            return view('errors.404');

        return view("modules.sales.item.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, $id)
    {
        $data = $request->except("_token");

         try {
            DB::beginTransaction();
            $item  = Item::find($id);

            $item->update($data);

            $purchase_tax = Tax::find($request->purchase_tax_id);
            $sales_tax    = Tax::find($request->sales_tax_id);

            $item->purchase_tax_amount = $purchase_tax->amount;
            $item->purchase_tax_type   = $purchase_tax->type;
            $item->purchase_tax_code   = $purchase_tax->code;
            $item->purchase_tax        = $purchase_tax->percentage;

            $item->sales_tax_amount = $sales_tax->amount;
            $item->sales_tax_type   = $sales_tax->type;
            $item->sales_tax_code   = $sales_tax->code;
            $item->sales_tax        = $sales_tax->percentage;
            $item->save();

          DB::commit();
            return redirect()->back()->with("sucesso", "Artigo atualizado com sucesso ");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return redirect()->back()->with("erro", "Ocorreu algum erro ao atualizar o artigo.");
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if ( $item == NULL ) {
            return redirect()->back()->with("erro","Artigo não encotrado .");
        } else {
            $item->delete();
            return redirect()->back()->with("sucesso","Artigo eliminado .");
        }
    }
}
