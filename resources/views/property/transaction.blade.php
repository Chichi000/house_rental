    @extends('layouts.base')
    @section('body')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            @include('partials.navbar')
            <hr class="horizontal dark mt-0">

            <div class="container-fluid">
                @if (count($errors) > 0)
                    @include('layouts.flash-messages')
                @else
                    @include('layouts.flash-messages')
                @endif
            </div>

            <div class="container-fluid py-4">
                @foreach ($property as $property)
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="card mb-4">
                                <div class="card-header p-3 pb-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Order Details</h6>
                                            {{-- <p class="text-sm mb-0">
                                                Order no. <b>241342</b> from <b>23.02.2021</b>
                                            </p> --}}
                                            <hr class="horizontal dark mt-0 mb-4">
                                            <p class="text-sm">
                                                <b class="text-danger">Notes:</b> This process may take a few days, so it is
                                                important to be patient and follow up with the landlord if necessary. If your
                                                payments directly through the online rental platform, making the rental process
                                                more convenient and accessible for both tenants and landlords alike. if application is accepted, you may be able to sign a lease agreement and make rent.
                                            </p>    
                                            
                                            </p>
                                        </div>
                                        {{-- <a href="javascript:;" class="btn bg-gradient-secondary ms-auto mb-0">Invoice</a> --}}
                                    </div>
                                </div>
                                <div class="card-body p-3 pt-0">
                                    <hr class="horizontal dark mt-0 mb-4">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="d-flex">
                                                <div>
                                                    <img src="{{ asset($property->imagePath) }}" class="avatar avatar-xxl me-3"
                                                        alt="product image">
                                                </div>
                                                <div>
                                                    <h6 class="text-lg mb-0 mt-2">{{ $property->state }}, {{ $property->city }}
                                                    </h6>
                                                    <p class="text-sm mb-3">Area {{ $property->area }}, Garage
                                                        {{ $property->garage }}, Bedroom {{ $property->bedroom }}, Property
                                                        {{ $property->bathroom }}</p>
                                                    <span class="badge badge-sm bg-gradient-success">Available</span>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 col-md-6 col-12 my-auto text-end">
                                        <a href="javascript:;" class="btn bg-gradient-info mb-0">Contact Us</a>
                                        <p class="text-sm mt-2 mb-0">Do you like the product? Leave us a review <a
                                                href="javascript:;">here</a>.</p>
                                    </div> --}}
                                    </div>
                                    <form role="form text-left" method="POST"
                                        action="{{ route('transaction.requestProperty') }}">
                                        @csrf
                                        <hr class="horizontal dark mt-4 mb-4">
                                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <h6 class="mb-3">Payment</h6>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="paymentRadio"
                                                        id="paymentRadioId" value="Gcash" required> 
                                                    <label for="customRadio1">Gcash</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="paymentRadio"
                                                        id="paymentRadioId" value="Paymaya" required>
                                                    <label for="customRadio2">Paymaya</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="paymentRadio"
                                                        id="paymentRadioId" value="Credit Card" required>
                                                    <label for="customRadio2">Credit Card</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="paymentRadio"
                                                        id="paymentRadioId" value="In-Person" required>
                                                    <label for="customRadio2">In-Person</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-6 col-12">
                                                <h6 class="mb-3">Days in property</h6>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="rent-days" class="form-control-label">Number of
                                                                    days</label>
                                                                <input class="form-control" type="number" value="5"
                                                                    id="days-counter" step="5" min="5"
                                                                    max="30" name="total_days">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr class="horizontal dark mt-0 mb-4">
                                            <h6 class="mb-3">Price Summary</h6>
                                            <div class="d-flex justify-content-between">
                                                <span class="mb-2 text-sm">
                                                    Property Price:
                                                </span>
                                                <span class="text-dark font-weight-bold ms-2">₱
                                                    {{ number_format($property->rent, 2, '.', ',') }} x&nbsp;<a
                                                        id="days"></a></span>
                                            </div>
                                            {{-- <div class="d-flex justify-content-between">
                                            <span class="mb-2 text-sm">
                                                Delivery:
                                            </span>
                                            <span class="text-dark ms-2 font-weight-bold">$14</span>
                                        </div> --}}
                                            <div class="d-flex justify-content-between">
                                                <span class="text-sm">
                                                    Taxes:
                                                </span>
                                                <span class="text-dark ms-2 font-weight-bold">₱ 0.00</span>
                                            </div>
                                            <div class="d-flex justify-content-between mt-4">
                                                <span class="mb-2 text-lg">
                                                    Total:
                                                </span>
                                                <span class="text-dark text-lg ms-2 font-weight-bold">₱
                                                    <a id="result" name="total_amount"></a></span>
                                                <input type="hidden" value="result" name="total_amount">
                                            </div>

                                        </div>
                                        {{-- <button type="submit" href="{{ route('showTransaction', $property->id) }}"
                                            class="btn bg-gradient-success btn-lg btn-rounded w-100 mt-4 mb-0">Request
                                            now</button> --}}
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn bg-gradient-success btn-lg btn-rounded w-100 mt-4 mb-0" data-toggle="modal"
                                            data-target="#confirmModal">
                                            Request Transaction
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                                            aria-labelledby="confirmModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmModalLabel">Confirm Transaction
                                                            Request</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to request this transaction?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn bg-gradient-primary"
                                                            id="confirmButton">Confirm</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

            <div class="container-fluid">
                @include('partials.footer')
            </div>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const input = document.getElementById('days-counter');
                const result = document.getElementById('result');
                const days = document.getElementById('days');

                input.value = '5';

                const value = input.value;
                const total = value * {{ $property->rent }};


                result.innerText = `${total.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                days.innerText = `${value} days`;

                input.addEventListener('input', (event) => {
                    const value = event.target.value;
                    const total = value * {{ $property->rent }};
                    result.innerText = `${total.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                    days.innerText = `${value} days`;
                });
            });
        </script>
    @endsection
