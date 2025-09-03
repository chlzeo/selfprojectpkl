@extends('layouts.frontend.master')
    <h2 class="text-xl font-bold mb-4">Reset Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-4">
            <input type="email" name="email" value="{{ old('email', $request->email) }}" 
                   class="w-full border rounded p-2" required autofocus>
        </div>

        <div class="mb-4">
            <input type="password" name="password" placeholder="Password Baru" 
                   class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" 
                   class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            Reset Password
        </button>
    </form>
@endsection