@extends('frontend.master')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-sm p-4" style="min-width:340px;max-width:400px;width:100%;">
        <h2 class="text-xl font-bold mb-4 text-center">Reset Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <input type="email" name="email" value="{{ old('email', $request->email) }}" 
                       class="w-full border rounded p-2 form-control" required autofocus>
            </div>

            <div class="mb-4">
                <input type="password" name="password" placeholder="Password Baru" 
                       class="w-full border rounded p-2 form-control" required>
            </div>

            <div class="mb-4">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" 
                       class="w-full border rounded p-2 form-control" required>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded btn btn-success w-100">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection