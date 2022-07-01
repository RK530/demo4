<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use  RealRashid\SweetAlert\SweetAlertServiceProvider ;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
            $employees = User::search($request->search)->paginate(10);
           
        }
        
       else{ 
           $employees = User::latest()->paginate(10);
       }
        return view('backend.employee.index2',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       return view('backend.employee.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      /*  $request->validate([
            'name' => 'required',
            'email'=>'required',
            'password' =>'required|min:8|confirmed',
            'userGroup'=>'required',
            'contact'=>'required|min:8,',
            'address'=>'required',
           
        ]);*/
        
        $validator=Validator::make($request->all(),[
            'name' => 'required|unique:users',
           // 'email'=>'required|unique:users',
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
       
        //
        
       /* event(new Registered($newEmployee = $this->createRegister($request)));
        $this->guard();
        $newEmployee = new User();
        $newEmployee->name=$request->name;
        $newEmployee->password=$request->password;
        //$newEmployee->email=$request->email;
        $newEmployee->image=$imageName;
        $newEmployee->save();*/
        event(new Registered($newEmployee = User::create([
            'name' => $request['name'],
            'password' => Hash::make($request['password']),
        ])));
        $newEmployee->image=$imageName;
        $newEmployee->save();


        alert()->html("employee created successfully.",'<a href="/employee"  class="btn btn-primary"> Back </a> 
        <a href="/employee/create"  class="btn btn-primary"> stay</a>',"success");
        return back();
                        //->withSuccess('employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee)
    {
        return view('backend.employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee)
    {
        return view('backend.employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $employee)
     {
        
        /*if(Hash::check($request->input('password_confirmation')&& $request->input('password'), $employee->password)){
            return 'true';
        }
        else{
            return 'false';
        }*/
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
            //$request['password'] = bcrypt($request->password);
            
            $employee=User::whereId($employee->id)->update([
                'name'=>$request['name'],
                'image'=>$imageName,
                'password' => Hash::make($request['password']),
            ]);
            alert()->html("employee edited successfully.",'<a href="/employee"  class="btn btn-primary"> Back </a> 
            <a href=""  class="btn btn-primary"> stay</a>',"success");
          
            return back();
        }else{
            $employee=User::whereId($employee->id)->update([
                'name'=>$request['name'],
                'password' => Hash::make($request['password']),
            ]);
       
        alert()->html("employee edited successfully.",'<a href="/employee"  class="btn btn-primary"> Back </a> 
        <a href=""  class="btn btn-primary"> stay</a>',"success");
      
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
                   
                    $employee=User::whereId($employee->id)->update([
                        'name'=>$request['name'],
                        'image'=>$imageName,
                    ]);
                    
                    alert()->html("employee edited successfully.",'<a href="/employee"  class="btn btn-primary"> Back </a> 
                    <a href=""  class="btn btn-primary"> stay</a>',"success");
                  
                    return back();
                }else{
                return 'false';
                $employee->update($request->except('password'));
               
                alert()->html("employee edited successfully.",'<a href="/employee"  class="btn btn-primary"> Back </a> 
                <a href=""  class="btn btn-primary"> stay</a>',"success");
              
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
   /* protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showAdminLoginForm()
    {
        return view('backend.auth.adminLogin');
    }

    public function adminLogin(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        return auth();
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
       /* if(Auth::guard('admin')->attempt(array($fieldType => $request['username'], 'password' => $request['password'])))
        {
            return $this->sendLoginResponse($request, $this->guard()->user());
        }else{
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }
        **/
       /* if(auth('admin')->attempt(array($fieldType => $request['name'], 'password' => $request['password'])))
        {
            $this->sendLoginResponse($request, $this->guard()->user());
            return redirect()->route('home');
        }else{
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
        $this->hasTooManyLoginAttempts($request)) {
        $this->fireLockoutEvent($request);
       
        return $this->sendLockoutResponse($request);
    }
       /* $username=$request->input('username');
        $email=DB::table('employees')->where('username','=',$username)
                                     ->select('email')
                                     ->get();
        
        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('backend.auth.password_confirmed_at', time());
            }

            
            return $this->sendLoginResponse($request, $this->guard()->user());
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }*/


   /* protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
            $this->password()=>[trans('auth.password')]
        ]);
    }

    public function username()
    {
        return 'username';
    }
    public function password()
    {
        return 'password';
    }

    public function logout()
    {
        if(Auth::guard('admin')->check()) // this means that the admin was logged in.
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin');
        }
    }

    protected function sendLoginResponse(Request $request,$user)
    {      
        $this->clearLoginAttempts($request);
        $user->last_login_time = Carbon::now()->toDateTimeString();
        $user->save();
        $user->last_login_ip = $request->getClientIp();
        $user->save();
        return redirect()->route('home');
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }*/
    

}
