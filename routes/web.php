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

// Página de inicio con formulario de login/registro
Route::get('/', function () {
    return view('index'); // Asegúrate de que index.blade.php existe en resources/views/
})->name('index');



// Ruta para procesar el login
Route::post('/login', function (Request $request) {
    // Validar los datos ingresados
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.products.index'); // Ir directo al CRUD
        }

        return redirect()->route('home'); // Usuarios normales
    }

    // Si falla, devuelve con error
    return back()->withErrors([
        'password' => 'La contraseña ingresada es incorrecta. Inténtalo de nuevo.'
    ])->withInput(); // para mantener el email escrito
})->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/products', ProductController::class)->names('admin.products');
});

// Ruta para mostrar el formulario de registro
Route::get('/register', function () {
    return view('auth.register'); // Asegúrate de crear esta vista
})->name('register.form');


// Ruta para procesar el registro de usuarios
Route::post('/register', function (Request $request) {
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);
    
    // Crear usuario en la base de datos
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Encripta la contraseña
    ]);

    return redirect()->route('index')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
})->name('register');

// Mostrar formulario para solicitar link de restablecimiento
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Enviar link por correo
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');

// Mostrar el formulario para establecer una nueva contraseña
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

// Procesar el restablecimiento de contraseña
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('index')->with('success', 'Contraseña restablecida. Inicia sesión con tu nueva contraseña.')
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');

Route::get('/politica-de-datos', function () {
    return view('politica'); // Crea esta vista en resources/views/politica.blade.php
})->name('politica');

// Ruta para cerrar sesión
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('index')->with('success', 'Sesión cerrada correctamente.');
})->name('logout');

// Páginas del sitio
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/tenis', function () {
    return view('tenis');
})->name('tenis');

Route::get('/ropa-masculina', function () {
    return view('ropa_masculina');
})->name('ropa.masculina');

Route::get('/ropa-femenina', function () {
    return view('ropa_femenina');
})->name('ropa.femenina');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/confirmacion', function () {
    Session::forget('cart'); // Vaciar el carrito
    return view('cart.confirm');
})->name('cart.confirm');




Route::get('/contact', function () {
    return view('contact');
})->name('contact'); // 🔹 Ahora se puede acceder con GET para mostrar la página

Route::post('/contact', function (Request $request) {
    // Validar datos
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
    ]);

    // Guardar en la base de datos
    Message::create($request->all());

    return back()->with('success', 'Mensaje enviado correctamente.');
})->name('contact.post');

