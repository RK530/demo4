<?php

namespace App\Http\Controllers;

use App\Models\tblqzt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class tblQztController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search')){
            $dreams = tblqzt::search($request->search)->paginate(10);

        }

        else{
            $dreams = tblqzt::sortable()->paginate(10);
        }


        return view('backend.qzt.index',compact('dreams'))
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
    public function edit(tblqzt $qzt)
    {
        return view('backend.qzt.edit',compact('qzt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tblqzt $qzt)
    {
        $validator=Validator::make($request->all(),[
            'number' => 'required|min:3|max:3',
        ]);

        if ($validator->fails()) {

            Alert::error('Error Title', $validator->errors()->all());
            return back()->withErrors($validator)
                ->withInput();
        }
        $qzt->update($request->all());
        alert()->html("Dream is edited successfully.",'<a href="/qzt"  class="btn btn-primary"> Back </a>
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
