<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Area\StoreAreaRequest;
use App\Http\Requests\Area\UpdateAreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["areas"] = Area::paginate(10);
        return view("administracao.pages.area.index",$dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("administracao.pages.area.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaRequest $request)
    {
        $dados = $request->except("_token");
        Area::create($dados);
        return redirect()->back()->with("sucesso", "Area salvo com sucesso ");
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
        $dados['area'] = Area::find($id);

        if ($dados['area'] == NULL)
            return view('errors.404');

        return view("administracao.pages.area.edit",$dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaRequest $request, $id)
    {
        $dados = $request->except("_token");
        $area  = Area::find($id);

        $area->update($dados);
        return redirect()->back()->with("sucesso", "Área atualizado com sucesso ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);

        if ( $area == NULL ) {
            return redirect()->back()->with("erro","Área não encotrada .");
        } else {
            $area->delete();
            return redirect()->back()->with("sucesso","Área eliminada .");
        }
    }
}
