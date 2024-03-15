<!-- thankyou.blade.php -->

@extends("site.layouts.main")

@section('bg-img', asset('site_assets/img/home-bg.jpg'))
@section('title', 'Thank You')
@section('subheading', 'Thank you for subscribing!')

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thank You!</div>
                    <div class="card-body">
                        <p>Thank you for subscribing to our service. Your payment was successful, and your subscription is now active.</p>

                        <!-- You can provide additional information or links here -->

                        <a href="{{ route('site.home') }}" class="btn btn-primary">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
