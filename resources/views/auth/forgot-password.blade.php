<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Chlzengine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #111;
            color: #fff;
        }
        .login-card {
            background: #1a1a1a;
            border: 1.5px solid #e00;
            border-radius: 12px;
        }
        .form-control, .form-control:focus {
            background: #222;
            color: #fff;
            border-color: #e00;
        }
        .btn-danger {
            background: #e00;
            border: none;
            font-weight: bold;
        }
        .btn-danger:hover {
            background: #b00;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
        <div class="login-card p-4 shadow" style="width:100%; max-width:350px;">
            <div class="text-center mb-4">
                <img src="./transport.png" alt="Logo" width="48" height="48" style="background:#111; border-radius:50%; border:2px solid #e00;">
                <h2 class="fw-bold mt-2" style="color:#e00;">Forgot password</h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST" autocomplete="off" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 
                <div class="d-grid">
                    <button type="submit" class="btn btn-danger">Send</button>
                </div>
            </form>
            <a href="{{ route('login') }}" class="btn btn-outline-danger mt-3 w-100" style="font-weight:bold;">&larr; Back</a>
        </div>
    </div>
</body>
</html>