<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblTotoSite;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TotoSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)

    {
        if($request->filled('search')){
            $sites = tblTotoSite::search($request->search)->paginate(10);

        }
        else{
            $sites = tblTotoSite::paginate(10);
        }
        return view('backend.totoSite.index',compact('sites'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.totoSite.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'siteName' => 'required|unique:tbl_toto_sites|max:100',
            'flag'=>'required|max:3',
            'country'=>'required',
            'color'=>'required|max:50',
            'siteImage'=>'required',
            'status'=>'required',

        ]);
        if ($validator->fails()) {

            Alert::error('Error Title', $validator->errors()->all());
            return back()->withErrors($validator)
                         ->withInput();
         }
         $image=$request->file('siteImage');
         $imageName=$image->getClientOriginalName();
         $image->move(public_path('public/images'),$imageName);
         $site=new tblTotoSite();
         $site->siteName=$request->siteName;
         $site->flag=$request->flag;
         $site->country=$request->country;
         $site->color=$request->color;
         $site->siteImage=$imageName;
         $site->status=$request->status;
         $site->save();
         alert()->html("Toto Site  is created successfully.",'<a href="/totoSite"  class="btn btn-primary"> Back </a>
         <a href="/totoSite/create"  class="btn btn-primary"> Stay</a>',"success");
         return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(tblTotoSite $totoSite)
    {

        return view('backend.totoSite.show',compact('totoSite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(tblTotoSite $totoSite)
    {
        return view('backend.totoSite.edit',compact('totoSite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tblTotoSite $totoSite)
    {
        $validator=Validator::make($request->all(),[
            'siteName' => 'required|max:100',
            'flag'=>'required|max:3',
            'country'=>'required',
            'color'=>'required|max:50',
            'status'=>'required',


        ]);
        if ($validator->fails()) {

            Alert::error('Error Title', $validator->errors()->all());
            return back()->withErrors($validator)
                         ->withInput();
         }

        if($request->hasFile('siteImage')!=''){
            $image=$request->file('siteImage');
            $image->move(public_path('public/images'),$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();
            $request['siteImage']=$imageName;


            $totoSite->update($request->all());
            $totoSite->update(['siteImage'=>$imageName]);
            alert()->html("Toto Site is edited successfully.",'<a href="/totoSite"  class="btn btn-primary"> Back </a>
            <a href=""  class="btn btn-primary"> Stay</a>',"success");

            return back();
        }else{
            $totoSite->update($request->all());
            alert()->html("Toto Site is edited successfully.",'<a href="/totoSite"  class="btn btn-primary"> Back </a>
            <a href=""  class="btn btn-primary"> Stay</a>',"success");
            return back();
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
        tblTotoSite::find($id)->delete();

        return back()
               ->with('success','Record has been delete successfully');
    }
}
