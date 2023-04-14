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


        <div class="container-fluid py-4">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="card-header pb-0">
                        <h6>Tenant CRUD</h6>
                        <hr class="horizontal dark mt-0">
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if(Illuminate\Support\Facades\Auth::user()->role == 'tenant')
                        <li class="nav-mail">
                        @php
              
              $u = Illuminate\Support\Facades\Auth::user();
               $shown = false;
               $total_messages = 0;
               $user_data = array();
               $time = array();
               $ids = array();
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
                              $ids[$i] = $mess->conversation->user_1_reference->id;;
                              $time[$i] = date('h:i', strtotime($d)) . ' ' . date('a', strtotime($d));
                              $i++;
                          }
                      }
                  }
              
              }
                      @endphp
                          <a href="{{route('con',[Illuminate\Support\Facades\Auth::id()])}}"><div title="Masseges" class="font-icon"><i class="fa fa-envelope-o"></i><span style="float: left; margin-right: 5px; margin-top: 5px;" class="badge badge-light">{{$total_messages}}</span></div></a>
                        </li>
                        {{-- <li class="nav-calendar">
                          <a href="#"><div title="Your Post" class="font-icon"><i class="fa fa-calendar"></i><span style="float: left; margin-right: 5px; margin-top: 6px;" class="badge badge-light">{{\App\AdvisorPost::all()->count()}}</span></div></a>
                        </li> --}}
                        @elseif(Illuminate\Support\Facades\Auth::user()->role == 'landlord')
                        <li class="nav-settings">
                          <a href="#"><div title="Notification" class="font-icon"><i class="fa fa-tasks"></i><span style="float: left; margin-right: 5px; margin-top: 3px;" class="badge badge-light"></span></div></a>
                        </li>
                        <li class="nav-mail">
                          @php
              
                  $u = Illuminate\Support\Facades\Auth::user();
                   $shown = false;
                   $total_messages = 0;
                   $user_data = array();
                   $time = array();
                   $ids = array();
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
                                  $ids[$i] = $mess->conversation->user_1_reference->id;;
                                  $time[$i] = date('h:i', strtotime($d)) . ' ' . date('a', strtotime($d));
                                  $i++;
                              }
                          }
                      }
              
                  }
                          @endphp
                          <a href="{{route('con',[Illuminate\Support\Facades\Auth::id()])}}"><div title="Masseges" class="font-icon"><i class="fa fa-envelope-o"></i><span style="float: left; margin-right: 5px; margin-top: 5px;" class="badge badge-light">{{$total_messages}}</span></div></a>
                        </li>
              
                        {{-- <li class="nav-calendar">
                          <a href="#"><div title="Your Post" class="font-icon"><i class="fa fa-calendar"></i><span style="float: left; margin-right: 5px; margin-top: 6px;" class="badge badge-light">{{\Illuminate\Support\Facades\Auth::user()->advisorrelation->post->count()}}</span></div></a>
                        </li> --}}
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
              <div class="content">
              @for($i=0;$i<count($msgids);$i++)
                                      <a href="{{route('inbox',[$msgids[$i]])}}"><div class="chat_list">
                                              <div class="chat_people">
                                                  <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                                  <div class="chat_ib">
                                                      <h5>{{\App\Models\User::find($msgids[$i])->user_name}}<span class="chat_date">{{$msgtimes[$i] . ' ' . $msgdate[$i]}}</span></h5>
                                                      <p>You have @if($unseen[$i] != 0) <span style="color: red"> {{$unseen[$i]}} </span> @else {{$unseen[$i]}} @endif Unseen Message</p>
                                                  </div>
                                              </div>
                                          </div>
                                      </a>
                                  @endfor
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('js/masonry.pkgd.min.js')}}"></script>
	<script src="{{asset('js/magnific-popup.min.js')}}"></script>
	<script src="{{asset('js/main.js')}}"></script>
	<!-- smodel script -->
@endsection
