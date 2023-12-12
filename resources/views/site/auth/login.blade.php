@extends("site.layouts.main")

@section('bg-img', asset('site_assets/img/home-bg.jpg'))
@section('title', 'Login - Clean Blog')
@section('subheading', 'A Clean Blog Theme by Start Bootstrap')
@section("content")
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview">
                <h2 class="post-title">Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <p class="post-meta">
                    Don't have an account? <a href="{{ route('register') }}">Register here</a>.
                </p>
                @if (Route::has('password.request'))
                    <p class="post-meta">
                        Forgot your password? <a href="{{ route('password.request') }}">Reset here</a>.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
