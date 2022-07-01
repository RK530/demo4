<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use  RealRashid\SweetAlert\SweetAlertServiceProvider ;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    use ThrottlesLogins,AuthenticatesUsers;
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
            $users = User::search($request->search)->paginate(10);

        }

       else{
           $users = User::latest()->paginate(10);
       }
        return view('backend.user.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return view('backend.user.create');

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
            'name' => 'required|unique:users',
            'password' =>'required|min:8|confirmed',
            'image'=>'required|max:2048',
        ]);

        if ($validator->fails()) {

           Alert::error('Error Title', $validator->errors()->all());
           return back()->withErrors($validator)
                        ->withInput();
        }
        $image=$request->file('image');
        $imageName=$image->getClientOriginalName();
        $image->move(public_path('public/images'),$imageName);

        event(new Registered($newEmployee = User::create([
            'name' => $request['name'],
            'password' => Hash::make($request['password']),
        ])));
        $newEmployee->image=$imageName;
        $newEmployee->save();


        alert()->html("user is created successfully.",'<a href="/user"  class="btn btn-primary"> Back </a>
        <a href="/user/create"  class="btn btn-primary"> Stay</a>',"success");
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('backend.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
     {

        $validator=Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($request->password != ''){
            $validator=Validator::make($request->all(),[
                'password' =>'required|min:8|confirmed',
                'name' => 'required',
            ]);


        if ($validator->fails()) {

           Alert::error('Error Title', $validator->errors()->all());
           return back()->withErrors($validator)
                        ->withInput();
        }

        if($request->hasFile('image')!=''){
            $image=$request->file('image');
            $image->move(public_path('public/images'),$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();
            $request['image']=$imageName;

            $user=User::whereId($user->id)->update([
                'name'=>$request['name'],
                'image'=>$imageName,
                'password' => Hash::make($request['password']),
            ]);
            alert()->html("user is edited successfully.",'<a href="/user"  class="btn btn-primary"> Back </a>
            <a href=""  class="btn btn-primary"> Stay</a>',"success");

            return back();
        }else{
            $user=User::whereId($user->id)->update([
                'name'=>$request['name'],
                'password' => Hash::make($request['password']),
            ]);

        alert()->html("user is edited successfully.",'<a href="/user"  class="btn btn-primary"> Back </a>
        <a href=""  class="btn btn-primary"> Stay</a>',"success");

        return back();
    }
}       else{
               $validator=Validator::make($request->all(),[
                    'name' => 'required',
                ]);
                if ($validator->fails()) {

                    Alert::error('Error Title', $validator->errors()->all());
                    return back()->withErrors($validator)
                                 ->withInput();
                 }

                 if($request->hasFile('image')!=''){
                    $image=$request->file('image');
                    $image->move(public_path('public/images'),$image->getClientOriginalName());
                    $imageName=$image->getClientOriginalName();
                    $request['image']=$imageName;

                    $user=User::whereId($user->id)->update([
                        'name'=>$request['name'],
                        'image'=>$imageName,
                    ]);

                    alert()->html("user is edited successfully.",'<a href="/user"  class="btn btn-primary"> Back </a>
                    <a href=""  class="btn btn-primary"> Stay</a>',"success");

                    return back();
                }else{
                return 'false';
                $user->update($request->except('password'));

                alert()->html("user is edited successfully.",'<a href="/user"  class="btn btn-primary"> Back </a>
                <a href=""  class="btn btn-primary"> Stay</a>',"success");

                return back();
            }


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
        User::find($id)->delete();

        return back()
               ->with('success','Record has been delete successfully');
    }

   public function createRegister(Request $request){
         $image=$request->file('image');
         $imageName=$image->getClientOriginalName();
         $newEmployee= User::create([
        'name'=>$request['name'],
        'password'=> Hash::make($request['password']),
        'image'=>$imageName,

    ]);
    return $newEmployee;
   }



}
