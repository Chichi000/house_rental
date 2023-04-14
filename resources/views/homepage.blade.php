@extends('layouts.base')
@section('body')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('partials.navbar')
        <hr class="horizontal dark mt-0">

        
        <div class="container-fluid py-4">
            <form method="GET" action="{{ route('search_property') }}">
                <div class="card">
                    <div class="m-3 mt-4">
                        <div class="d-flex">
                            {{-- <input type="hidden" name="property_id" value=""> --}}
                                <div class="col">
                                    <input name="rent" class="form-control" type="search" placeholder="Amount">
                                </div>
                                <div class="col">
                                    <input name="city" class="form-control" type="search" placeholder="City">
                                </div>
                                <div class="col">
                                    <select select class="form-control" name="state" id="state">
                                        <option value="">Choose state...</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->state }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <button class="btn bg-gradient-primary mb-0 ms-2">
                                {{-- <i class="ni ni-send"></i> --}}
                                 Search
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                @foreach ($properties as $property)
                    <div class="col-md-4 mt-4">
                        <div class="card">
                            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                <div class="position-relative">
                                    <a class="d-block blur-shadow-image" href="{{ route('showProperty', $property->id) }}">
                                        <img src="{{ asset($property->imagePath) }}"
                                            class="img-fluid shadow border-radius-lg">
                                    </a>
                                </div>
                                <div class="card-body px-1 pt-3">
                                    <p class="text-gradient text-primary mb-2 text-sm">{{ $property->area }} sqr •
                                        {{ $property->bedroom }} Bedroom • {{ $property->bathroom }} Bathroom •
                                        {{ $property->garage }} Garage</p>
                                    <a href="javascript:;">
                                        <h5>
                                            {{ $property->city }}, {{ $property->state }}
                                        </h5>
                                    </a>
                                    <p>
                                        {{ Str::limit($property->description, 150, '...') }}
                                    </p>
                                    <a href="{{ route('showProperty', $property->id) }}"
                                        class="btn bg-gradient-primary">Price:
                                        ₱{{ number_format($property->rent, 2, '.', ',') }}</a>
                                    {{-- <button type="button" class="btn btn-outline-primary btn-sm">Chat</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @include('partials.footer')
    </main>
@endsection
