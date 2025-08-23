<?php

namespace App\Http\Controllers\Modules\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\Sales\Category\StoreCategoryRequest;
use App\Http\Requests\Modules\Sales\Category\UpdateCategoryRequest;
use App\Models\Sales\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["categories"] = Category::paginate(10);
        return view("modules.sales.category.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("modules.sales.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->except("_token");
        Category::create($data);
        return redirect()->back()->with("sucesso", "Categoria salvo com sucesso ");
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
        $data['category'] = Category::find($id);

        if ($data['category'] == NULL)
            return view('errors.404');

        return view("modules.sales.category.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $data = $request->except("_token");
        $category  = Category::find($id);

        $category->update($data);
        return redirect()->back()->with("sucesso", "Categoria atualizado com sucesso ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if ( $category == NULL ) {
            return redirect()->back()->with("erro","Categoria não encotrada .");
        } else {
            $category->delete();
            return redirect()->back()->with("sucesso","Categoria eliminada .");
        }
    }
}
