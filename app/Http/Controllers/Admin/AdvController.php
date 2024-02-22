<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvRequest;
use App\Models\Adv;

class AdvController extends Controller
{

    public function __construct()
    {

    }
    public function index()
    {
        $models = Adv::paginate(5);
        return view('admin.adv.index',['models'=>$models]);
    }
    public function create()
    {
//        $companies=Adv::all();
        return view('admin.adv.form');
    }
    public function store(AdvRequest $request)
    {
        Adv::create($request->all());
        return redirect()->route('admin.adv.index');
    }
    public function edit(Adv $adv)
    {
//        $companies=Adv::all();
        return view('admin.adv.form',['model'=>$adv]);
    }
    public function update(AdvRequest $advRequest, Adv $adv)
    {
        $adv->update($advRequest->all());
        return redirect()->back();
    }
    public function destroy(Adv $adv)
    {
        $adv->delete();
        return redirect()->back();
    }
}
