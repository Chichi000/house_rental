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
                            <div class="row">
                            @for ($i = 0; $i < count($msgids); $i++)
                            <div class="col-md-4 mt-4">
                            <div class="card-body">
                                <div class="row justify-content-start mb-4">
                                    <div class="col-auto">
                                        <div class="card ">
                                            <div class="card-body py-2 px-3">
                                                <a href="{{ route('inbox', [$msgids[$i]]) }}">
                                                    <div class="chat_list">
                                                        <div class="chat_people">
                                                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png"
                                                                    alt="sunil"> </div>
                                                            <div class="chat_ib">
                                                                <h5>{{ \App\Models\User::find($msgids[$i])->user_name }}<span
                                                                        class="chat_date">{{ $msgtimes[$i] . ' ' . $msgdate[$i] }}</span></h5>
                                                                <p>You have @if ($unseen[$i] != 0)
                                                                        <span style="color: red"> {{ $unseen[$i] }} </span>
                                                                    @else
                                                                        {{ $unseen[$i] }}
                                                                    @endif Unseen Message</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="d-flex align-items-center text-sm opacity-6">
                                                    <i class="ni ni-check-bold text-sm me-1"></i>
                                                    <small>3:14am</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endfor
                            </div>
                            @elseif(Illuminate\Support\Facades\Auth::user()->role_id_fk == 3)
                            @endif
                        </div>
                    </div>
                </div>

                <footer class="footer pt-3  ">
                    <div class="container-fluid">
                        @include('partials.footer')
                    </div>
                </footer>
            </div>
    </main>

@endsection
