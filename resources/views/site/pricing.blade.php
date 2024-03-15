@extends("site.layouts.main")

@section('bg-img', asset('site_assets/img/home-bg.jpg'))
@section('title', 'Pricing')
@section('subheading', 'Choose a plan that fits your needs')
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="py-4">Pricing Table</h4>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($pricingPlans as $plan)
                <div class="col-md-4">
                    <div class="pricingTable10">
                        <div class="pricingTable-header">
                            <h3 class="heading">{{ $plan->name }}</h3>
                            <span class="price-value">
                                <span class="currency">$</span> {{ $plan->price }}
                                <span class="month">/{{ $plan->interval }}</span>
                            </span>
                        </div>
                        <div class="pricing-content">
                            <ul>
                                <li>{{ $plan->features }}</li>
                            </ul>
                            @auth
                                <a href="{{ route('site.checkout', $plan->id) }}" class="read btn btn-primary btn-block">Subscribe</a>
                            @else
                                <p class="text-info">Please <a href="{{ route('login') }}">log in</a> to subscribe.</p>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
<style>
    .pricingTable10 {
        text-align: center;
        margin-bottom: 30px;
    }

    .pricingTable10 .read {
        display: inline-block;
        font-size: 16px;
        color: #fff;
        text-transform: uppercase;
        background: #09b1c5;
        padding: 8px 25px;
        margin: 30px 0;
        transition: all 0.3s ease 0s;
    }

    .pricingTable10:hover .read {
        background: #fff;
        color: #09b1c5;
    }

    .pricingTable10 .pricingTable-header {
        padding: 30px 0;
        background: #4d4d4d;
        position: relative;
        transition: all 0.3s ease 0s;
    }

    .pricingTable10:hover .pricingTable-header {
        background: #09b2c6;
    }

    .pricingTable10 .heading {
        font-size: 20px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 0;
    }

    .pricingTable10 .price-value {
        display: inline-block;
        position: relative;
        font-size: 55px;
        font-weight: 700;
        color: #09b1c5;
        transition: all 0.3s ease 0s;
    }

    .pricingTable10:hover .price-value {
        color: #fff;
    }

    .pricingTable10 .currency {
        font-size: 30px;
        font-weight: 700;
        position: absolute;
        top: 6px;
        left: -19px;
    }

    .pricingTable10 .month {
        font-size: 16px;
        color: #fff;
        position: absolute;
        bottom: 15px;
        right: -30px;
        text-transform: uppercase;
    }

    .pricingTable10 .pricing-content {
        padding-top: 30px;
        background: #fff;
        position: relative;
    }

    .pricingTable10 .pricing-content ul {
        padding: 0 20px;
        margin: 0;
        list-style: none;
    }

    .pricingTable10 .pricing-content ul li {
        font-size: 15px;
        font-weight: 700;
        color: #777473;
        padding: 10px 0;
        border-bottom: 1px solid #d9d9d8;
    }

    .pricingTable10 .pricing-content ul li:last-child {
        border-bottom: none;
    }

</style>
@endpush
