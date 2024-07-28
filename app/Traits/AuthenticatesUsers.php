<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


trait AuthenticatesUsers {
    use RedirectsUsers;

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $this->validateLogin($request);
      
        if ($this->attemptLogin($request)) {
            
            if($request->is_user == '1'){

                return redirect()->route('user.dashboard');
            }
            return $this->sendLoginResponse($request);
        }
     
        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request) {
        $request->validate([
            $this->email() => 'required|string',
            'password' => 'required|string'
        ]);
    }

    protected function attemptLogin(Request $request) {
        return $this->guard()->attempt(
            $this->credentials($request)
        );
    }

    protected function credentials(Request $request) {
        return $request->only($this->email(), 'password');
    }

    protected function sendLoginResponse(Request $request) {
        $request->session()->regenerate();
    
        return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect()->intended($this->redirectedPath());
    }

    protected function sendFailedLoginResponse(Request $request) {
        throw ValidationException::withMessages([
            $this->email() => [trans('auth.failed')],
        ]);
    }

    public function email() {
        return 'email';
    }

    public function logout(Request $request) {
        $this->guard()->logout();

        $request->session()->invalidate();
         if($request->is_user == '1'){

            return redirect()->route('show.loginForm');
         } 
        return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect('/admin/login');
    }

    protected function guard() {
        return Auth::guard();
    }
}
