<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
class AuthController extends Controller
{
    public function index(): View{
        return view('auth.login');
    }

    public function register(): View{
        return view('auth.register');
    }

    public function postLogin(Request $request): RedirectResponse{
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('blogs')->withSuccess('You Have Successfully loggedin');
        }

        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }

    public function postRegister(Request $request): RedirectResponse
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $user = $this->create($data);
            
        Auth::login($user); 

        return redirect("blogs")->withSuccess('Great! You have Successfully loggedin');
    }

    public function dashboard(){
        if(Auth::check()){
            return view('blogs');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
