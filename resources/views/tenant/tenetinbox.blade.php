@extends('layouts.base')
@section('body')
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            @if (Auth::user()->role == 'tenant')
                                <img src="{{ asset(Auth::user()->tenants->imagePath) }}" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            @elseif(Auth::user()->role == 'landlord')
                                <img src="{{ asset(Auth::user()->landlords->imagePath) }}" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            @endif
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ Auth::user()->name }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ Auth::user()->role }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-4">
                    <div class="card blur shadow-blur max-height-vh-70 overflow-auto overflow-x-hidden mb-5 mb-lg-0">
                        <div class="card-header p-3">
                            <h6>Inbox</h6>
                            <input type="email" class="form-control" placeholder="Search Contact" aria-label="Email"
                                onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                        <div class="card-body p-2">
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

                                @for ($i = 0; $i < count($msgids); $i++)
                                    <a href="{{ route('inbox', [urlencode($msgids[$i])]) }}" class="d-block p-2">
                                        <div class="d-flex p-2">
                                            <img alt="Image"
                                                src="{{ asset(\App\Models\User::find($msgids[$i])->landlords->imagePath) }}"
                                                class="avatar shadow">
                                            <div class="ms-3">
                                                <h6 class="mb-0">{{ \App\Models\User::find($msgids[$i])->name }}</h6>
                                                <p class="text-muted text-xs mb-2">
                                                    {{ \App\Models\User::find($msgids[$i])->email }}
                                                </p>
                                                <p class="text-muted text-xs mb-2">
                                                    <small>{{ $msgtimes[$i] . ' ' . $msgdate[$i] }}</small>
                                                </p>
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
                                                <p class="text-muted text-xs mb-2">
                                                    {{ \App\Models\User::find($msgids[$i])->email }}
                                                </p>
                                                <p class="text-muted text-xs mb-2">
                                                    <small>{{ $msgtimes[$i] . ' ' . $msgdate[$i] }}</small>
                                                </p>
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
                <div class="col-8">
                    <div class="card blur shadow-blur max-height-vh-70">
                        @if (Illuminate\Support\Facades\Auth::user()->role == 'tenant')
                            <div class="card-header shadow-lg">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="d-flex align-items-center">
                                            <img alt="Image" src="{{ asset($users->landlords->imagePath) }}"
                                                class="avatar">
                                            <div class="ms-3">
                                                <h6 class="mb-0 d-block">{{ $users->name }}</h6>
                                                <span class="text-sm text-dark opacity-8">{{ $users->role }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body overflow-auto overflow-x-hidden">
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
                                <div class="card-header shadow-lg">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="d-flex align-items-center">
                                                <img alt="Image" src="{{ asset($users->tenants->imagePath) }}"
                                                    class="avatar">
                                                <div class="ms-3">
                                                    <h6 class="mb-0 d-block">{{ $users->name }}</h6>
                                                    <span class="text-sm text-dark opacity-8">{{ $users->role }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body overflow-auto overflow-x-hidden">
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

                        {{-- pov ni landlord --}}
                        {{-- <div class="row justify-content-start mb-4">
                                <div class="col-auto">
                                    <div class="card ">
                                        <div class="card-body py-2 px-3">
                                            <p class="mb-1">
                                                You can easily get it; The content here is all free
                                            </p>
                                            <div class="d-flex align-items-center text-sm opacity-6">
                                                <i class="ni ni-check-bold text-sm me-1"></i>
                                                <small>4:42pm</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}


                        {{-- pov ni tenant --}}
                        {{-- <div class="row justify-content-end text-right mb-4">
                                <div class="col-auto">
                                    <div class="card bg-gray-200">
                                        <div class="card-body py-2 px-3">
                                            <p class="mb-0">
                                                At the end of the day … the native dev apps is where users are
                                            </p>
                                            <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                                                <i class="ni ni-check-bold text-sm me-1"></i>
                                                <small>4:42pm</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                        <div class="content">
                            <div class="container">
                                <div id="chat-window">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-block">
                        <form class="align-items-center">
                            <div class="d-flex">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type here"
                                        aria-label="Message example input" onfocus="focused(this)"
                                        onfocusout="defocused(this)" id="msg">
                                </div>
                                <div class="Area">
                                    <button type="button" onclick="clickX()" value="SEND"
                                        class="btn bg-gradient-primary mb-0 ms-2">
                                        <i class="ni ni-send"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.footer');
        </div>
    </main>

    <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- smodel script -->
    <script>
        var username = "{{ \Illuminate\Support\Facades\Auth::id() }}";

        function clickX() {
            sendMessage();
        }


        function sendMessage() {

            var dt = new Date();
            var time = dt.toLocaleString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            })
            var month = dt.toLocaleString("en-us", {
                month: "long"
            });
            var date = dt.getDate() + " " + month;
            var msg = $('#msg').val();
            $('#msg').val('');
            if (msg != "") {

                // $('#chat-window').append(
                //     '<div class="Area"> <div class="R"><a href="https://twitter.com/MariamMassadeh"><img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSxU35znsBhAWQd5BouLIVtH1P4WNa0JZ_XXpyViHOIARbM2igbNgC6_kp5"/><div class="tooltip">Mariam Massadeh - 23 Years<br/>Computer Engineer<br/>Jordan</div></a></div><div class="text L textL">' +
                //     msg + '<span style="float:right;">' + date + '    |    ' + time + '</span></div></div>'

                // );

                $('#chat-window').append(
                    '<div class="Area"><div class="row justify-content-end text-right mb-4"><div class="col-auto"><div class="card bg-gray-200"><div class="card-body py-2 px-3"><p class="mb-0">' +
                    msg +
                    '</p><div class="d-flex align-items-center justify-content-end text-sm opacity-6"><i class="ni ni-check-bold text-sm me-1"></i><small>' +
                    date + '    |    ' + time + '</small></div></div></div></div></div></div>'
                );

            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('sendmessage') }}",
                data: {
                    id1: username,
                    id2: {{ $id }},
                    message: msg,
                },
                success: function(data) {
                    // notTyping();
                    console.log(data);
                },
            });
        }

        function retrieveUnSeenChatMessages() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('readunseenmessage') }}",
                data: {
                    id1: username,
                    id2: {{ $id }}
                },
                success: function(data) {

                    console.log(data);
                    if (data.length > 0) {
                        for (var i = 0; i < data[0].length; i++) {
                            if (username == data[1][i]) {
                                // '+time+'    |    '+date+'

                                // $('#chat-window').append(
                                //     '<div class="Area"> <div class="R"><a href="https://twitter.com/MariamMassadeh"><img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSxU35znsBhAWQd5BouLIVtH1P4WNa0JZ_XXpyViHOIARbM2igbNgC6_kp5"/><div class="tooltip">Mariam Massadeh - 23 Years<br/>Computer Engineer<br/>Jordan</div></a></div><div class="text L textL">' +
                                //     data[0][i] + '<span style="float:right;">' + data[1][i] + '    |    ' +
                                //     data[2][i] + '</span></div></div>');

                                $('#chat-window').append(
                                    '<div class="Area"><div class="row justify-content-end text-right mb-4"><div class="col-auto"><div class="card bg-gray-200"><div class="card-body py-2 px-3"><p class="mb-0">' +
                                    data[0][i] +
                                    '</p><div class="d-flex align-items-center justify-content-end text-sm opacity-6"><i class="ni ni-check-bold text-sm me-1"></i><small>' +
                                    data[1][i] + '    |    ' + data[2][i] +
                                    '</small></div></div></div></div></div></div>');


                            } else {
                                // $('#chat-window').append(
                                //     '<div class="Area"><div class="L"><a href="https://twitter.com/SamiMassadeh"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrEyVlaWx0_FK_sz86j-CnUC_pfEqw_Xq_xZUm5CMIyEI_-X2hRUpx1BHL"/><div class="tooltip">Sami Massadeh - 28 Years<br/>Doctor <br/>Jordan</div></a></div><div class="text R textR">' +
                                //     data[0][i] + '  <span style="float:right;">' + data[1][i] +
                                //     '    |    ' + data[2][i] + '</span></div></div>');

                                $('#chat-window').append(
                                    '<div class="Area"><div class="row justify-content-start mb-4"><div class="col-auto"><div class="card "><div class="card-body py-2 px-3"><p class="mb-1">' +
                                    data[0][i] +
                                    '</p><div class="d-flex align-items-center text-sm opacity-6"><i class="ni ni-check-bold text-sm me-1"></i><small>' +
                                    data[1][i] + '    |    ' + data[2][i] +
                                    '</small></div></div></div></div></div></div>');

                            }

                        }
                        var messageBody = document.querySelector('#chat-window');
                        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                    }
                },
            });
        }

        function retrieveChatMessages(numberofmessages) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('readusermessage') }}",
                data: {
                    id1: username,
                    id2: {{ $id }},
                    numberofmessages: numberofmessages
                },
                success: function(data) {

                    console.log("Data is This " + data);
                    $('#chat-window').empty();
                    if (data.length > 0) {
                        for (var i = 0; i < data[0].length; i++) {
                            if (username == data[1][i]) {
                                // $('#chat-window').append(
                                //     '<div class="Area"> <div class="R"><a href="https://twitter.com/MariamMassadeh"><img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSxU35znsBhAWQd5BouLIVtH1P4WNa0JZ_XXpyViHOIARbM2igbNgC6_kp5"/><div class="tooltip">Mariam Massadeh - 23 Years<br/>Computer Engineer<br/>Jordan</div></a></div><div class="text L textL">' +
                                //     data[0][i] + '<span style="float:right;">' + data[2][i] + '    |    ' +
                                //     data[3][i] + '</span></div></div>');

                                // $('#chat-window').append(
                                // '<div class="Area"> <div class="R"><a href="https://twitter.com/MariamMassadeh"><img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSxU35znsBhAWQd5BouLIVtH1P4WNa0JZ_XXpyViHOIARbM2igbNgC6_kp5"/><div class="tooltip">Mariam Massadeh - 23 Years<br/>Computer Engineer<br/>Jordan</div></a></div><div class="text L textL">' +
                                // data[0][i] + '<span style="float:right;">' + data[1][i] + '    |    ' +
                                // data[2][i] + '</span></div></div>');

                                $('#chat-window').append(
                                    '<div class="Area"><div class="row justify-content-end text-right mb-4"><div class="col-auto"><div class="card bg-gray-200"><div class="card-body py-2 px-3"><p class="mb-0">' +
                                    data[0][i] +
                                    '</p><div class="d-flex align-items-center justify-content-end text-sm opacity-6"><i class="ni ni-check-bold text-sm me-1"></i><small>' +
                                    data[2][i] + '    |    ' + data[3][i] +
                                    '</small></div></div></div></div></div></div>');

                            } else {
                                // $('#chat-window').append(
                                //     '<div class="Area"><div class="L"><a href="https://twitter.com/SamiMassadeh"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrEyVlaWx0_FK_sz86j-CnUC_pfEqw_Xq_xZUm5CMIyEI_-X2hRUpx1BHL"/><div class="tooltip">Sami Massadeh - 28 Years<br/>Doctor <br/>Jordan</div></a></div><div class="text R textR">' +
                                //     data[0][i] + '  <span style="float:right;">' + data[2][i] +
                                //     '    |    ' + data[3][i] + '</span></div></div>');

                                $('#chat-window').append(
                                    '<div class="Area"><div class="row justify-content-start mb-4"><div class="col-auto"><div class="card "><div class="card-body py-2 px-3"><p class="mb-1">' +
                                    data[0][i] +
                                    '</p><div class="d-flex align-items-center text-sm opacity-6"><i class="ni ni-check-bold text-sm me-1"></i><small>' +
                                    data[2][i] + '    |    ' + data[3][i] +
                                    '</small></div></div></div></div></div></div>');
                            }

                        }
                    }
                },
            });
        }

        retrieveChatMessages(1000);
        pullData();

        function pullData() {
            retrieveUnSeenChatMessages();
            setTimeout(pullData, 3000);
            console.log("This is in Pull Data");
        }
    </script>
@endsection
