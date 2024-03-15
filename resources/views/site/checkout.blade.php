@extends("site.layouts.main")

@section('bg-img', asset('site_assets/img/home-bg.jpg'))
@section('title', 'Checkout')
@section('subheading', 'Complete your subscription')

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row no-gutters">
                    <!-- Checkout Summary Column -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Checkout Summary</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="w-50">Name</th>
                                            <td class="w-50">{{ $plan->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $plan->features }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>${{ $plan->price }}/{{ $plan->interval }}</td>
                                        </tr>
                                        <!-- Add more plan details as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details Column -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Payment Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" id="stripe" value="stripe">
                                    <label class="form-check-label" for="stripe">
                                        <img src="{{ asset('site_assets/img/stripe.png') }}" height="80px" width="80px" alt="Stripe" class="payment-icon">
                                        <span class="ml-2">Pay with Stripe</span>
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" id="razorpay" value="razorpay">
                                    <label class="form-check-label" for="razorpay">
                                        <img src="{{ asset('site_assets/img/razorpay.png') }}" height="80px" width="80px" alt="Razorpay" class="payment-icon">
                                        <span class="ml-2">Pay with Razorpay</span>
                                    </label>
                                </div>

                                <div id="stripe-form" class="payment-form d-none">
                                    <!-- Stripe payment form -->
                                    <!-- Include necessary Stripe JS and create the form -->
                                </div>

                                <div id="razorpay-form" class="payment-form d-none">
                                    <!-- Razorpay payment form -->
                                    <!-- Include necessary Razorpay JS and create the form -->
                                </div>

                                <div class="mt-3">
                                    <p class="mb-1">Total Price: <span class="text-primary">${{ $plan->price }}</span></p>
                                    <button id="paynow" type="button" class="btn btn-primary btn-lg">Proceed to Payment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $("#paynow").click(function(){
               var selectedPaymentMethod = $("input[name='payment_method']:checked").val();
               var plan = @json($plan->id);
                if (selectedPaymentMethod === undefined) {
                    alert("Please choose one payment method");
                    return false;
                }
                $.ajax({
                    method: "POST",
                    url: "{{ route('site.pay') }}",
                    data: {
                        paymentMethod:selectedPaymentMethod,
                        plan:plan
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.payurl) {
                            window.location = data.payurl
                        }
                        console.log(data);
                    },
                    error: function(data){
                        console.error(data);
                    }
                });
            });
        });

    </script>
@endpush
