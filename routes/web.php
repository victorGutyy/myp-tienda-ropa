<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Message;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Página de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Ruta para procesar el login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.products.index');
        }

        return redirect()->route('home');
    }

    return back()->withErrors([
        'password' => 'La contraseña ingresada es incorrecta. Inténtalo de nuevo.'
    ])->withInput();
})->name('login.post');

// Rutas protegidas para el admin
Route::middleware(['auth'])->group(function () {
    Route::resource('admin/products', ProductController::class)->names('admin.products');
});

// Ruta para mostrar el formulario de registro
Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

// Ruta para procesar el registro
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('home')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
})->name('register');

// Password Reset
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill(['password' => Hash::make($password)])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('home')->with('success', 'Contraseña restablecida. Inicia sesión con tu nueva contraseña.')
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');

// Política de tratamiento de datos
Route::get('/politica-de-datos', function () {
    return view('politica');
})->name('politica');

// Cerrar sesión
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home')->with('success', 'Sesión cerrada correctamente.');
})->name('logout');

// Otras páginas públicas
Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/tenis', [ProductController::class, 'tenis'])->name('tenis');

Route::get('/ropa-masculina', [ProductController::class, 'ropaMasculina'])->name('ropa.masculina');


Route::get('/ropa-femenina', [ProductController::class, 'ropaFemenina'])->name('ropa.femenina');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/confirmacion', function () {
    Session::forget('cart');
    return view('cart.confirm');
})->name('cart.confirm');

// Contacto
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
    ]);

    Message::create($request->all());

    return back()->with('success', 'Mensaje enviado correctamente.');
})->name('contact.post');
