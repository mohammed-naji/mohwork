@extends('front.master')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <h2 class="mb-4 text-center">You will pay <span class="text-danger">${{ $project->price }}</span> for <span class="text-success">{{ $project->title }}</span></h2>

            <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}"></script>
            <form action="{{ route('admin.projects.status', $project) }}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>

            {{-- <input id="card-holder-name" type="text">

            <!-- Stripe Elements Placeholder -->
            <div id="card-element"></div>

            <button id="card-button" data-secret="{{ env('STRIPE_SECRET') }}">
                Update Payment Method
            </button> --}}
        </div>
    </div>
</div>


@endsection

@section('js')

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;

cardButton.addEventListener('click', async (e) => {
    const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
            payment_method: {
                card: cardElement,
                billing_details: { name: cardHolderName.value }
            }
        }
    );

    if (error) {
        // Display "error.message" to the user...
    } else {
        // The card has been verified successfully...
    }
});
</script>

@stop
