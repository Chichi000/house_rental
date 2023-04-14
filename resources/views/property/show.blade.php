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

        <div class="container-fluid pt-3">
            <div class="row mt-4 removable">
                @foreach ($property as $property)
                    <div class="col-lg-8 col-md-6">
                        <div class="card">
                            <div class="card-header d-flex align-items-center border-bottom py-3">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:;">
                                        <img src="{{ asset($property->landlords->imagePath) }}" class="avatar"
                                            alt="profile-image">
                                    </a>
                                    <div class="mx-3">
                                        <a href=""
                                            class="text-dark font-weight-600 text-sm">{{ $property->landlords->first_name }}
                                            {{ $property->landlords->last_name }}</a>
                                        <small
                                            class="d-block text-muted">{{ $property->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <div class="text-end ms-auto">
                                    @guest
                                    <a type="submit" class="btn bg-gradient-primary mb-0" href="{{ route('inbox', $property->user_id) }}">
                                        <i class="fa-solid fa-comment"></i> Chat
                                    </a>
                                    @elseif(Auth::user()->role == 'tenant')
                                    <a type="submit" class="btn bg-gradient-primary mb-0" href="{{ route('inbox', $property->user_id) }}">
                                        <i class="fa-solid fa-comment"></i> Chat
                                    </a>
                                    @else
                                    
                                    @endguest
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="heading-small text-muted">About property</h6>
                                <p> {{ $property->description }} </p>
                                <img alt="Image placeholder" src="{{ asset($property->imagePath) }}"
                                    class="img-fluid border-radius-lg shadow-lg">
                                <div class="row align-items-center px-2 mt-4 mb-2">
                                    {{-- <div class="col-sm-6">
                                        <div class="d-flex">
                                            <div class="d-flex align-items-center">
                                                <i class="ni ni-like-2 me-1 cursor-pointer"></i>
                                                <span class="text-sm me-3 ">150</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="ni ni-chat-round me-1 cursor-pointer"></i>
                                                <span class="text-sm me-3">36</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="ni ni-curved-next me-1 cursor-pointer"></i>
                                                <span class="text-sm me-2">12</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 d-none d-sm-block">
                                        <div class="d-flex align-items-center justify-content-sm-end">
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                    data-toggle="tooltip" data-original-title="Jessica Rowland">
                                                    <img alt="Image placeholder" src="../../../assets/img/team-5.jpg"
                                                        class="">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                    data-toggle="tooltip" data-original-title="Audrey Love">
                                                    <img alt="Image placeholder" src="../../../assets/img/team-2.jpg"
                                                        class="rounded-circle">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                    data-toggle="tooltip" data-original-title="Michael Lewis">
                                                    <img alt="Image placeholder" src="../../../assets/img/team-1.jpg"
                                                        class="rounded-circle">
                                                </a>
                                            </div>
                                            <small class="ps-2 font-weight-bold">and 30+ more</small>
                                        </div>
                                    </div> --}}
                                    <hr class="horizontal dark">
                                </div>

                                <div class="mb-1 max-height-vh-50 overflow-auto overflow-x-hidden">
                                    <h6 class="h5 mt-0">Reviews</h6>
                                    @foreach ($reviews as $review)
                                        <div class="d-flex mt-3 mr-4">
                                            <div class="flex-shrink-0">
                                                <img alt="Image placeholder" class="avatar rounded-circle"
                                                    src="{{ asset($review->imagePath) }}">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="h5 mt-0">{{ $review->name }}</h6>
                                                <p class="text-sm">{{ $review->comment }}</p>
                                                <div class="d-flex">
                                                    {{-- <div>
                                                    <i class="ni ni-like-2 me-1 cursor-pointer"></i>
                                                </div>
                                                <span class="text-sm me-2">3 likes</span>
                                                <div>
                                                    <i class="ni ni-curved-next me-1 cursor-pointer"></i>
                                                </div> --}}
                                                    {{-- <span class="text-sm me-2">2 shares</span> --}}
                                                    <span
                                                        class="text-sm me-2">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex mt-4">
                                        {{ $reviews->links() }}
                                    </div>
                                </div>
                                
                                @auth
                                    @if (Auth::user()->role == 'tenant')
                                        <div class="d-flex mt-4 mr-4">
                                            <div class="flex-shrink-0">
                                                <img alt="Image placeholder" class="avatar rounded-circle me-3"
                                                    src="{{ asset(Auth::user()->tenants->imagePath) }}">
                                            </div>
                                            <div class="flex-grow-1 my-auto">
                                                <form method="POST" action="{{ route('review.store') }}">
                                                    @csrf
                                                    {{-- <input type="hidden" name="property_id" value="{{ $property->id }}">
                                                        <input name="comment" class="form-control" placeholder="Write your comment" rows="1"></input> --}}
                                                    {{-- <div class="input-group-append">
                                                          <button class="btn bg-gradient-primary btn-sm" type="button">Submit</button>
                                                        </div> --}}

                                                    <div class="d-flex">
                                                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                                                        <textarea name="comment" class="form-control" placeholder="Write your comment" rows="1"></textarea>
                                                        <button class="btn bg-gradient-primary mb-0 ms-2">
                                                            <i class="ni ni-send"></i>
                                                        </button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    @else
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4 position-sticky top-2">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="mb-0">Transaction </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <h6 class="heading-small text-muted mb-4">Landlord information</h6>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">First
                                                        name</label>
                                                    <input type="text" id="input-first-name" class="form-control"
                                                        value="{{ $property->landlords->first_name }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-last-name">Last
                                                        name</label>
                                                    <input type="text" id="input-last-name" class="form-control"
                                                        value="{{ $property->landlords->last_name }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email" id="input-email" class="form-control" value="{{ $user->email }} " readonly>
                                        </div>
                                    </div>
                                </div> --}}
                                    <hr class="horizontal dark my-4">
                                    <!-- Address -->
                                    <h6 class="heading-small text-muted mb-4">Property information</h6>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-address">Address</label>
                                                    <input id="input-address" class="form-control"
                                                        placeholder="Home Address" value="{{ $property->address }}"
                                                        type="text" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-city">City</label>
                                                    <input type="text" id="input-city" class="form-control"
                                                        placeholder="City" value="{{ $property->city }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-country">State</label>
                                                    <input type="text" id="input-country" class="form-control"
                                                        placeholder="Country" value="{{ $property->state }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-city">Area</label>
                                                    <input type="text" id="input-city" class="form-control"
                                                        placeholder="City" value="{{ $property->area }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-country">Bedroom</label>
                                                    <input type="text" id="input-country" class="form-control"
                                                        placeholder="Country" value="{{ $property->bedroom }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-country">Bathroom</label>
                                                    <input type="text" id="input-country" class="form-control"
                                                        placeholder="Country" value="{{ $property->bathroom }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark my-4">
                                    <h6 class="heading-small text-muted mb-4">Select</h6>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="rent-days" class="form-control-label">Number of days</label>
                                                    <input class="form-control" type="number" value="5"
                                                        id="days-counter" step="5" min="5"
                                                        max="30">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark my-4">
                                    <!-- Description -->
                                    <h6 class="heading-small text-muted mb-4">Total ammount</h6>
                                    <div>
                                        <li class="d-flex">
                                            <p class="mb-0">Tax:</p>
                                            <p class="ms-auto"> ₱ 0.00</p>
                                        </li>
                                        <li class="d-flex">
                                            <p class="mb-0">Price day:</p>
                                            <p class="ms-auto"> ₱ {{ number_format($property->rent, 2, '.', ',') }} x&nbsp; <div id="days"></div></p>
                                        </li>
                                        <li class="d-flex">
                                            {{-- <p class="mb-0">Price:</p> --}}
                                            <p class="ms-auto"> <strong> Total</strong>: ₱&nbsp;<div id="result"></div>
                                            </p>
                                        </li>
                                    </div>
                                    
                                    <hr class="horizontal dark">
                                    <div class="text-center">
                                        <a type="submit" href="{{ route('showTransaction', $property->id) }}"
                                            class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Rent now</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('partials.footer')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('days-counter');
            const result = document.getElementById('result');
            const days = document.getElementById('days');

            input.value = '5';

            const value = input.value;
            const total = value * {{ $property->rent }};
            

            result.innerText = `Total: ${total.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
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
