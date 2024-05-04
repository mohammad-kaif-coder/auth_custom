<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller {

    public function register() {
        return view('auth.register');
    }
    //register 
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
       
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)   
        ]);
//        $credentials = $request->only('email', 'password');
//        Auth::attempt($credentials);
//        $request->session()->regenerate();
        return redirect()->route('login')
                        ->withSuccess('You have successfully registered');
    }
    public function login(){
        return view('auth.login');
    }
    //login
    public function authenticate(Request $request){
        
       
        
        //validate the request data
        $credentials =$request-> validate([
            'email' => 'required|email|max:250',
            'password' => 'required|min:8'
        ]);
        $remamber = $request->has('remamber')? 'true':'false';
        
        //attempt to authenticate 
       if(Auth::attempt($credentials,$remamber)){
           $request->session()->regenerate();
           return redirect()->intended('home')->with('success','Login Successfully'); 
       }else{
           
           return redirect()->back()->withInput()->withErrors(['email' => 'Invalid email or password']);
           
       }
    }
    //dashboard
    public function home() {
        return view('home');
    }
    
    //logout 
    public function logout(Request $request) {
        auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You have been logged sussccessfully');
    }
    
}
