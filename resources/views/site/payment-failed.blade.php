@extends("site.layouts.main")

@section('bg-img', asset('site_assets/img/home-bg.jpg'))
@section('title', 'Payment Failed')
@section('subheading', 'Oops! Payment Failed')

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h4>Payment Failed</h4>
                    </div>
                    <div class="card-body">
                        <p>We're sorry, but it seems that there was an issue processing your payment.</p>
                        <p>Please try again or contact customer support for assistance.</p>
                        <a href="" class="btn btn-primary">Return to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
