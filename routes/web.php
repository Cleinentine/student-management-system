<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeanController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('account', [UserController::class, 'edit'])->name('account');
    Route::post('account', [UserController::class, 'update']);
    Route::put('account', [AuthController::class, 'update']);

    Route::get('dean', [DeanController::class, 'index'])->name('dean');
    Route::post('dean', [DeanController::class, 'update']);

    Route::get('faculties', [FacultyController::class, 'index'])->name('faculties');
    Route::post('faculties', [FacultyController::class, 'store']);
    Route::delete('faculties', [FacultyController::class, 'destroy']);

    Route::get('student', [StudentController::class, 'index'])->name('student');
    Route::post('student', [StudentController::class, 'storeUpdate']);

    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [UserController::class, 'create'])->name('register');

    Route::post('login', [AuthController::class, 'signin']);
    Route::post('register', [UserController::class, 'store']);

    /**
     * Reset Password
     */
    Route::get('forgot', [AuthController::class, 'forgot'])->name('password.request');

    Route::post('forgot', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        Inertia::flash('success', 'Email has been sent for password reset!');

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    /**
     * Change Password
     */
    Route::get('/change/{token}', function (Request $request, string $token) {
        return Inertia::render('ChangePasswordPage', [
            'email' => $request->query('email'),
            'token' => $token,
        ]);
    })->name('password.reset');

    Route::post('/change', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        Inertia::flash('success', 'Password has been updated successfully!');

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');
});
