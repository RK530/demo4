<?php

namespace App\Http\Controllers;

use App\Models\tblwzt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class tblWztController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search')){
            $dreams = tblwzt::search($request->search)->paginate(10);

        }

        else{
            $dreams = tblwzt::sortable()->paginate(10);
        }


        return view('backend.wzt.index',compact('dreams'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(tblwzt $wzt)
    {
        return view('backend.wzt.edit',compact('wzt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tblwzt $wzt)
    {
        $validator=Validator::make($request->all(),[
            'number' => 'required|min:4|max:4',
        ]);

        if ($validator->fails()) {

            Alert::error('Error Title', $validator->errors()->all());
            return back()->withErrors($validator)
                ->withInput();
        }
        $wzt->update($request->all());
        alert()->html("Dream is edited successfully.",'<a href="/wzt"  class="btn btn-primary"> Back </a>
        <a href=""  class="btn btn-primary"> Stay</a>',"success");

        return back();
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
