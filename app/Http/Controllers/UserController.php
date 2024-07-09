<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function index(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->has('remember');
        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1], $remember)) {
            return (User::find(Auth::user()['id'])->is_admin) ? redirect(route('admin.index')) : redirect(route('user.dashboard'));
        }else{
            return redirect()->back()->withInput();
        }
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        if($request->password !== $request->password_again || User::where('email', $request->email)->exists()){
            return back()->withInput();
        }
        $user = new User();
        $user->createUser($request);
        $this->logout();
        return redirect()->route('user.login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function oauth2()
    {
        try {
            $spbstuUser = Socialite::driver('spbstu')->stateless()->user();

            $q = User::select('id')
                ->where('email', $spbstuUser->user['email'])
                ->where('auth', 'cas')
                ->where('active', 1);

            $q1 = User::query()
                ->select('id')
                ->where('email', $spbstuUser->user['email'])
                ->where('auth', 'cas');

            if ($q->exists())
                Auth::login($q->first(), true);
            elseif (!$q1->exists())
                (new User())->createUserCAS($spbstuUser->user['email'], $spbstuUser->id, $spbstuUser->user['wsAsu']['structure'][0]['group_id']);

            return (User::find(Auth::user()['id'])->is_admin) ? redirect('admin.index') : redirect('user.dashboard');

        } catch (Exception $exception) {
            return redirect('auth.login');
        }
    }

    public function dashboard()
    {
        if ( ! isset(Auth::user()['id'])) {
            return redirect(route('user.login'));
        }
        else {
            return (User::find(Auth::user()['id'])->is_admin) ? redirect(route('admin.index')) : redirect(route('user.dashboard'));
        }
    }
}
