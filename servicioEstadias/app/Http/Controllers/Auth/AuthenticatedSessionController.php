<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    public function store(Request $request)
{
    // Validar los datos de inicio de sesión
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Verificar si el correo electrónico coincide con el correo deseado
        if ($request->email === 'desarrolloacademico@tecvalles.mx') {
            // Redirigir a la vista 'adminDashboard'
            return redirect()->route('adminDashboard');
        }elseif($request->email === 'vinculacion@tecvalles.mx'){
            return redirect()->route('vinculacionDashboard');
        } 
        else {
            // Redirigir a la vista 'dashboard'
            return redirect()->route('dashboard');
        }
    }

    // Si la autenticación falla, redirigir de vuelta con un mensaje de error
    return back()->withErrors([
        'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
    ]);
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
