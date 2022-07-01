<?php

namespace App\Http\Controllers;

use App\Models\tblResultApi;
use App\Models\tblTotoSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ResultApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search')){
            $urls = tblResultApi::search($request->search)->paginate(10);

        }

       else{
           $urls = tblResultApi::latest()->paginate(10);
       }

        return view('backend.result_api.index',compact('urls'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $totoSite=tblTotoSite::where('status','active')->get();
        return view('backend.result_api.create',compact('totoSite'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $validator=Validator::make($request->all(),[
            'api_url' => 'required',
            'toto_site'=>'required',
            'status' =>'required',

        ]);

        if ($validator->fails()) {

            Alert::error('Error Title', $validator->errors()->all());
            return back()->withErrors($validator)
                         ->withInput();
         }
         $url=new tblResultApi();
         $url->create($request->all());
         alert()->html("URL of Api is created successfully.",'<a href="/result_api/"  class="btn btn-primary"> Back </a>
         <a href="/result_api/create"  class="btn btn-primary"> Stay</a>',"success");
         return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(tblResultApi $result_api)
    {
        return view('backend.result_api.show',compact('result_api'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(tblResultApi $result_api)
    {
        $totoSite=tblTotoSite::where('status','active')->get();
        return view('backend.result_api.edit',compact('result_api','totoSite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tblResultApi $result_api)
    {

        $validator=Validator::make($request->all(),[
            'api_url' => 'required',
            'toto_site'=>'required',
            'status' =>'required',

        ]);

        if ($validator->fails()) {

            Alert::error('Error Title', $validator->errors()->all());
            return back()->withErrors($validator)
                         ->withInput();
         }

         $result_api->update($request->all());
         alert()->html("URL of Api is edited successfully.",'<a href="/result_api"  class="btn btn-primary"> Back </a>
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
        tblResultApi::find($id)->delete();

        return back()
               ->with('success','Record has been delete successfully');
    }
}
