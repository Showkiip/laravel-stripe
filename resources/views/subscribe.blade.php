<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Plan') }}
        </h2>
    </x-slot>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="page-header mt-5 py-3">
                <div class="container">
                    <div class="row">
                        @foreach ($plans as $plan)
                            <div class="col-lg-4 mb-lg-0 mb-4">
                                <div class="card shadow-lg">
                                    <span
                                        class="badge rounded-pill bg-light text-dark w-30 mx-auto">{{ $plan->name }}</span>
                                    <div class="card-header text-center pt-4 pb-3">
                                        <h1 class="font-weight-bold mt-2">
                                            <small class="text-lg align-top me-1">$</small>{{ $plan->amount }}<small
                                                class="text-lg">/mo</small>
                                        </h1>
                                    </div>
                                    <div class="card-body text-lg-start text-center pt-0">
                                        <!-- Check if user is authenticated and already has a selected plan -->
                                        @if (Auth::check() && Auth::user()->hasSelectedPlan())
                                            @if (Auth::user()->selectedPlan->id == $plan->id)
                                                <div class="alert alert-warning" role="alert">
                                                    You already have a selected this plan. If you want to change your
                                                    plan,
                                                    please cancel your current subscription first.
                                                </div>
                                            @endif
                                        @endif

                                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                            <i class="material-icons my-auto">done</i>
                                            <span class="ps-3">Lorem ipsum is an dummy</span>
                                        </div>
                                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                            <i class="material-icons my-auto">remove</i>
                                            <span class="ps-3">Lorem ipsum is </span>
                                        </div>
                                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                            <i class="material-icons my-auto">remove</i>
                                            <span class="ps-3">SLorem ipsum is an dummy text </span>
                                        </div>
                                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                            <i class="material-icons my-auto">remove</i>
                                            <span class="ps-3">Lorem ipsum is an dummy </span>
                                        </div>
                                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                            <i class="material-icons my-auto">remove</i>
                                            <span class="ps-3">Lorem ipsum is an dummy</span>
                                        </div>
                                        <!-- Other feature items -->

                                        <!-- Select plan button -->
                                        <a href="javascript:;" data-amount="{{ $plan->amount }}"
                                            data-plan-id="{{ $plan->id }}"
                                            class="btn btn-icon {{ Auth::check() && (Auth::user()->selected_plan_id == $plan->id || !Auth::user()->selected_plan_id) ? ' btn-danger' : ' btn-outline-success disabled' }} d-lg-block mt-3 mb-0 select-plan-btn"
                                            onclick="handlePlanSelection('{{ Auth::check() && Auth::user()->selected_plan_id == $plan->id ? 'cancel' : 'select' }}', '{{ $plan->id }}');"
                                            {{ Auth::check() && (Auth::user()->selected_plan_id == $plan->id || !Auth::user()->selected_plan_id) ? '' : 'disabled' }}>
                                            {{ Auth::check() && Auth::user()->selected_plan_id == $plan->id ? 'Cancel' : 'Select' }}
                                            <i class="fas fa-arrow-right ms-1"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach


                        {{-- <div class="col-lg-4 mb-lg-0 mb-4">
                            <div class="card bg-gradient-dark shadow-lg" style="background:#f305012e">
                                <span class="badge rounded-pill bg-primary w-30 mx-auto">Premium Plan</span>
                                <div class="card-header text-center pt-4 pb-3 bg-transparent">
                                    <h1 class="font-weight-bold mt-2 ">
                                        <small class="text-lg align-top me-1">$</small>159<small
                                            class="text-lg">/mo</small>
                                    </h1>
                                </div>
                                <div class="card-body text-lg-start text-center pt-0">
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto ">done</i>
                                        <span class="ps-3 ">Lorem ipsum is </span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto ">done</i>
                                        <span class="ps-3 ">Lorem ipsum is an dummy </span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto ">done</i>
                                        <span class="ps-3 ">Lorem ipsum is an dummy </span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto ">done</i>
                                        <span class="ps-3 ">Lorem ipsum is an dummy text </span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto ">remove</i>
                                        <span class="ps-3 ">Lorem ipsum is an dummy</span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto ">remove</i>
                                        <span class="ps-3 ">Lorem ipsum is an dummy</span>
                                    </div>
                                    <a href="javascript:;" data-amount="159"
                                        data-plan-id="price_1P5m80F5DVUNPpm9qmQWZ0Rd"
                                        class="btn btn-icon btn-danger d-lg-block mt-3 mb-0 select-plan-btn">
                                        Select
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-lg-0 mb-4">
                            <div class="card shadow-lg">
                                <span class="badge rounded-pill bg-light text-dark w-30 mx-auto">Standard Plan</span>
                                <div class="card-header text-center pt-4 pb-3">
                                    <h1 class="font-weight-bold mt-2">
                                        <small class="text-lg align-top me-1">$</small>399<small
                                            class="text-lg">/mo</small>
                                    </h1>
                                </div>
                                <div class="card-body text-lg-start text-center pt-0">
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto">done</i>
                                        <span class="ps-3">Lorem ipsum is an dummy</span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto">done</i>
                                        <span class="ps-3">Lorem ipsum is </span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto">done</i>
                                        <span class="ps-3">Lorem ipsum is an </span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto">done</i>
                                        <span class="ps-3">Lorem ipsum is an dummy </span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto">done</i>
                                        <span class="ps-3">Lorem ipsum is an dummy text</span>
                                    </div>
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <i class="material-icons my-auto">done</i>
                                        <span class="ps-3">Lorem ipsum is an dummy </span>
                                    </div>
                                    <a href="javascript:;" data-amount="399"
                                        data-plan-id="price_1P5m8HF5DVUNPpm9rWBAKJaJ"
                                        class="btn btn-icon btn-outline-danger d-lg-block mt-3 mb-0 select-plan-btn">
                                        Select
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- stripe card modal --}}
    <div class="modal fade" id="stripeModal" tabindex="-1" aria-labelledby="stripeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stripeModalLabel">Subscribe to Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Stripe Elements Container -->
                    <div id="stripe-elements-container"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="subscribe-btn">Subscribe</button>
                </div>
            </div>
        </div>
    </div>



    {{-- stripe js --}}
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function() {
            // Get all select plan buttons
            $('.select-plan-btn').click(function(event) {
                event.preventDefault();

                // Fetch plan details from button's data attributes
                var amount = $(this).data('amount');
                var planId = $(this).data('plan-id');
                var csrfToken = "{{ csrf_token() }}"
                var $btn = $(this);

                $btn.attr('disabled', true).addClass('disabled').html(
                    '<i class="fas fa-spinner fa-spin"></i> Processing...');

                // Open modal
                var modal = new bootstrap.Modal($('#stripeModal'));
                modal.show();

                // Initialize Stripe Elements
                var stripe = Stripe(
                    'pk_test_51IaGwxF5DVUNPpm9xmPgrNdzNji9zGfJXqxdu1sbctKIHBmORI3inRgVXpflBFRHyR4QwJyfXHNgIcLBtV1yxsHf00AsaqUoOE'
                );
                var elements = stripe.elements();
                var card = elements.create('card');
                card.mount('#stripe-elements-container');

                // Handle subscription when user clicks subscribe button
                $('#subscribe-btn').click(function() {
                    stripe.createPaymentMethod({
                        type: 'card',
                        card: card,
                    }).then(function(result) {
                        if (result.error) {
                            // Show error to user
                            alert(result.error.message);
                            $btn.attr('disabled', false).removeClass('disabled').html(
                                'Select <i class="fas fa-arrow-right ms-1"></i>');

                        } else {
                            // Send payment method to server to create subscription

                            $('#subscribe-btn').attr('disabled', true).html(
                                '<i class="fas fa-spinner fa-spin"></i> Subscribing...');
                            $.ajax({
                                url: '{{ route('subscribe.process') }}',
                                type: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                dataType: 'json',
                                data: JSON.stringify({
                                    payment_method: result.paymentMethod.id,
                                    plan_id: planId,
                                    amount: amount,
                                }),
                                success: function(data) {
                                    console.log(data)
                                    if (data.success) {
                                        alert('Thanks for subscription')
                                        window.location.href = data
                                            .redirect_url;
                                    } else {
                                        alert('Error:', "asdasd");
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log(xhr);
                                    // Show error to user
                                    var errorMessage = xhr.responseJSON ? xhr
                                        .responseJSON.error :
                                        'Unknown error occurred.';
                                    alert('Error:', errorMessage);
                                },
                                complete: function() {
                                    // Enable the button and hide loader
                                    $('#subscribe-btn').attr('disabled', false)
                                        .html('Subscribe');
                                    $btn.attr('disabled', false).removeClass(
                                        'disabled').html(
                                        'Select <i class="fas fa-arrow-right ms-1"></i>'
                                    );
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
