@extends('layouts.base')
@section('body')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
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


        @if (Illuminate\Support\Facades\Auth::user()->role == 'tenant')
            @php
                
                $u = Illuminate\Support\Facades\Auth::user();
                $shown = false;
                $total_messages = 0;
                $user_data = [];
                $time = [];
                $ids = [];
                $i = 0;
                
                if (count($u->user_1_conversation) > 0) {
                    $con = $u->user_1_conversation;
                    foreach ($con as $c) {
                        foreach ($c->message as $mess) {
                            if ($mess->is_user_1_seen == 0) {
                                $total_messages++;
                                $user_data[$i] = $mess->message_text;
                                $d = $mess->message_send_at;
                                $ids[$i] = $mess->conversation->user_2_reference->id;
                                $time[$i] = date('h:i', strtotime($d)) . ' ' . date('a', strtotime($d));
                                $i++;
                            }
                        }
                    }
                } else {
                    $con = $u->user_2_conversation;
                    foreach ($con as $c) {
                        foreach ($c->message as $mess) {
                            if ($mess->is_user_2_seen == 0) {
                                $total_messages++;
                                $user_data[$i] = $mess->message_text;
                                $d = $mess->message_send_at;
                                $ids[$i] = $mess->conversation->user_1_reference->id;
                                $time[$i] = date('h:i', strtotime($d)) . ' ' . date('a', strtotime($d));
                                $i++;
                            }
                        }
                    }
                }
            @endphp
        @elseif(Illuminate\Support\Facades\Auth::user()->role == 'landlord')
            @php
                
                $u = Illuminate\Support\Facades\Auth::user();
                $shown = false;
                $total_messages = 0;
                $user_data = [];
                $time = [];
                $ids = [];
                $i = 0;
                
                if (count($u->user_1_conversation) > 0) {
                    $con = $u->user_1_conversation;
                    foreach ($con as $c) {
                        foreach ($c->message as $mess) {
                            if ($mess->is_user_1_seen == 0) {
                                $total_messages++;
                                $user_data[$i] = $mess->message_text;
                                $d = $mess->message_send_at;
                                $ids[$i] = $mess->conversation->user_2_reference->id;
                                $time[$i] = date('h:i', strtotime($d)) . ' ' . date('a', strtotime($d));
                                $i++;
                            }
                        }
                    }
                } else {
                    $con = $u->user_2_conversation;
                    foreach ($con as $c) {
                        foreach ($c->message as $mess) {
                            if ($mess->is_user_2_seen == 0) {
                                $total_messages++;
                                $user_data[$i] = $mess->message_text;
                                $d = $mess->message_send_at;
                                $ids[$i] = $mess->conversation->user_1_reference->id;
                                $time[$i] = date('h:i', strtotime($d)) . ' ' . date('a', strtotime($d));
                                $i++;
                            }
                        }
                    }
                }
            @endphp
        @endif

        <div class="container-fluid py-4">
            {{-- <div class="col-4"> --}}
            <div class="col">
                <div class="card blur shadow-blur max-height-vh-70 overflow-auto overflow-x-hidden mb-5 mb-lg-0">
                    <div class="card-header p-3">
                        <h6>Friends</h6>
                        <input type="email" class="form-control" placeholder="Search Contact" aria-label="Email"
                            onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="card-body p-2">
                        @if (Illuminate\Support\Facades\Auth::user()->role == 'tenant')
                        @for ($i = 0; $i < count($msgids); $i++)
                            <a href="{{ route('inbox', [urlencode($msgids[$i])]) }}" class="d-block p-2">
                                <div class="d-flex p-2">
                                    <img alt="Image"
                                        src="{{ asset(\App\Models\User::find($msgids[$i])->landlords->imagePath) }}"
                                        class="avatar shadow">
                                    <div class="ms-3">
                                        <h6 class="mb-0">{{ \App\Models\User::find($msgids[$i])->name }}</h6>
                                        <p class="text-muted text-xs mb-2">{{ \App\Models\User::find($msgids[$i])->email }}
                                        </p>
                                        <p class="text-muted text-xs mb-2">
                                            <small>{{ $msgtimes[$i] . ' ' . $msgdate[$i] }}</small></p>
                                        <span class="text-muted text-sm col-11 p-0 text-truncate d-block">
                                            @if ($unseen[$i] != 0)
                                                <span style="color: red"> {{ $unseen[$i] }} </span>
                                            @else
                                                {{ $unseen[$i] }}
                                            @endif Unseen Message</p>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endfor
                        @elseif (Illuminate\Support\Facades\Auth::user()->role == 'landlord')
                        @for ($i = 0; $i < count($msgids); $i++)
                            <a href="{{ route('inbox', [urlencode($msgids[$i])]) }}" class="d-block p-2">
                                <div class="d-flex p-2">
                                    <img alt="Image"
                                        src="{{ asset(\App\Models\User::find($msgids[$i])->tenants->imagePath) }}"
                                        class="avatar shadow">
                                    <div class="ms-3">
                                        <h6 class="mb-0">{{ \App\Models\User::find($msgids[$i])->name }}</h6>
                                        <p class="text-muted text-xs mb-2">{{ \App\Models\User::find($msgids[$i])->email }}
                                        </p>
                                        <p class="text-muted text-xs mb-2">
                                            <small>{{ $msgtimes[$i] . ' ' . $msgdate[$i] }}</small></p>
                                        <span class="text-muted text-sm col-11 p-0 text-truncate d-block">
                                            @if ($unseen[$i] != 0)
                                                <span style="color: red"> {{ $unseen[$i] }} </span>
                                            @else
                                                {{ $unseen[$i] }}
                                            @endif Unseen Message</p>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endfor
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container-fluid py-4">
            <div class="row">
                @for ($i = 0; $i < count($msgids); $i++)
                    <div class="col-md-4 mt-4">
                        <div class="card card-profile mt-md-0 mt-5">
                            <a href="{{ route('inbox', [$msgids[$i]]) }}">
                                <div class="p-3">
                                    <img class="w-100 border-radius-md"
                                        src="{{ asset(\App\Models\User::find($msgids[$i])->landlords->imagePath) }}">
                                </div>
                            </a>
                            <div class="card-body blur justify-content-center text-center mx-4 mb-4 border-radius-md">
                                <h4 class="mb-0">{{ \App\Models\User::find($msgids[$i])->name }}</h4>
                                <p>{{ \App\Models\User::find($msgids[$i])->email }}</p>
                                <div class="row justify-content-center text-center">
                                    <div class="col-12 mx-auto">
                                        <h5 class="text-info mb-0">Message</h5>
                                        <small>
                                            @if ($unseen[$i] != 0)
                                                <span style="color: red"> {{ $unseen[$i] }} </span>
                                            @else
                                                {{ $unseen[$i] }}
                                            @endif Unseen Message</p>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div> --}}
        </div>
    </main>

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- smodel script -->
@endsection
