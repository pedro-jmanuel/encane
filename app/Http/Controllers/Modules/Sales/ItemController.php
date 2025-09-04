<?php

namespace App\Http\Controllers\Modules\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\Sales\Item\StoreItemRequest;
use App\Http\Requests\Modules\Sales\Item\UpdateItemRequest;
use App\Models\Sales\Category;
use App\Models\Sales\Item;
use Illuminate\Http\Request;

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
        return view("modules.sales.item.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $data = $request->except("_token");
        Item::create($data);
        return redirect()->back()->with("sucesso", "Artigo salvo com sucesso ");
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
        $item  = Item::find($id);

        $item->update($data);
        return redirect()->back()->with("sucesso", "Artigo atualizado com sucesso ");
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
