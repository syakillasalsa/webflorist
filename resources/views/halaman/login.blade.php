@extends('mainlayout')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 55vh;">
    <div class="text-center w-100" style="max-width: 400px;">
        <h2 class="mb-3">LOGIN</h2> <!-- dikasih jarak mb-3 -->

        <div class="card p-4 text-start"> <!-- text-start biar isinya rata kiri -->
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <div class="text-center mt-3">
                <p>Don't have an account?<a href="{{ route('register') }}">Sign up here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection