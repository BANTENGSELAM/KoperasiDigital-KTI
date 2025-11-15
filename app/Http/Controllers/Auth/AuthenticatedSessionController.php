<?php

namespace App\Http\Controllers\Auth;


use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        $user = Auth::user();
    


    // ... di dalam method store()
    if ($request->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }
    
    if ($request->user()->hasRole('petugas')) {
        return redirect()->route('petugas.dashboard');
    }
    
    if ($request->user()->hasRole('restoran_umkm')) {
        return redirect()->route('member.dashboard');
    }
    
    if ($request->user()->hasRole('edukator')) {
        return redirect()->route('education.manage');
    }

    return redirect()->route('home'); //  fallback ke home
        }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
