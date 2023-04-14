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
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total All Users</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $totalUser['tenant'] + $totalUser['admin'] + $totalUser['landlord'] }}
                                            {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Tenant</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $totalUser['tenant'] }}
                                            {{-- <span class="text-success text-sm font-weight-bolder">+3%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Landlord</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $totalUser['landlord'] }}
                                            {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Admin</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $totalUser['admin'] }}
                                            {{-- <span class="text-success text-sm font-weight-bolder">+5%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card z-index-2">
                        <div class="card-header p-3 pb-0">
                            <h6>Properties chart</h6>
                        </div>
                        <div class="card-body p-3">
                            @if (empty($totalPropChart))
                                <div id="app2"></div>
                            @else
                                <div class="row">
                                    {!! $totalPropChart->container() !!}
                                </div>
                                {!! $totalPropChart->script() !!}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-md-0 mt-4">
                    <div class="card z-index-2">
                        <div class="card-header p-3 pb-0">
                            <h6>Users chart</h6>
                        </div>
                        <div class="card-body p-3">
                            @if (empty($totalUsersChart))
                                <div id="app2"></div>
                            @else
                                <div class="row">
                                    {!! $totalUsersChart->container() !!}
                                </div>
                                {!! $totalUsersChart->script() !!}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card z-index-2">
                        <div class="card-header p-3 pb-0">
                            <h6>Total Profit in Month</h6>
                        </div>
                        <div class="card-body p-3">
                            @if(empty($profitChart))
                                <div id="app2"></div>
                            @else
                                <div class="row">
                                    {!! $profitChart->container() !!}
                                </div>
                                     {!! $profitChart->script() !!}
                             @endif   
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card z-index-2">
                        <div class="card-header p-3 pb-0">
                            <h6>Most Payment Method Used</h6>
                        </div>
                        <div class="card-body p-3">
                            @if(empty($mostpmChart))
                                <div id="app2"></div>
                            @else
                                <div class="row">
                                    {!! $mostpmChart->container() !!}
                                </div>
                                     {!! $mostpmChart->script() !!}
                             @endif   
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="timeline">
                @foreach ($newTenants as $tenant)
                    <div class="timeline-event">
                        <div class="timeline-event-icon"><i class="fas fa-user-plus"></i></div>
                        <div class="timeline-event-content">
                            <div class="timeline-event-title">New tenant account created</div>
                            <div class="timeline-event-description">{{ $tenant->name }} just signed up as a tenant.</div>
                            <div class="timeline-event-date">{{ $tenant->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                @endforeach

                @foreach ($newLandlords as $landlord)
                    <div class="timeline-event">
                        <div class="timeline-event-icon"><i class="fas fa-user-plus"></i></div>
                        <div class="timeline-event-content">
                            <div class="timeline-event-title">New landlord account created</div>
                            <div class="timeline-event-description">{{ $landlord->name }} just signed up as a landlord.
                            </div>
                            <div class="timeline-event-date">{{ $landlord->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                @endforeach

                @foreach ($orders as $order)
                    <div class="timeline-event">
                        <div class="timeline-event-icon"><i class="fas fa-shopping-cart"></i></div>
                        <div class="timeline-event-content">
                            <div class="timeline-event-title">New order received</div>
                            <div class="timeline-event-description">{{ $order->id }} was ordered by
                                {{ $order->tenants->first_name }} {{ $order->tenants->last_name }}.</div>
                            <div class="timeline-event-date">{{ $order->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                @endforeach
            </div> --}}

        </div>

        <div class="container-fluid py-4">
            <div class="row gx-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Timeline for new users</h6>
                        </div>
                        <div class="max-height-vh-50 overflow-auto overflow-x-hidden">
                        <div class="card-body p-3">
                            <div class="timeline timeline-one-side" data-timeline-axis-style="dotted">
                                @foreach ($newUsers as $user)
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        {{-- <i class="ni ni-bell-55 text-success text-gradient"></i> --}}
                                        <i class="fa-solid fa-user-plus"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $user->name }}</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $user->created_at->diffForHumans() }}</p>
                                        <p class="text-sm mt-3 mb-2"> just signed up as a {{ $user->role }}.
                                        </p>
                                        {{-- <span class="badge badge-sm bg-gradient-success">{{ $user->role }}</span> --}}
                                        @if($user->role === 'tenant')
                                        <span class="badge badge-sm bg-gradient-primary">{{ $user->role }}</span>
                                        @elseif($user->role == 'landlord')
                                        <span class="badge badge-sm bg-gradient-info">{{ $user->role }}</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-dark">{{ $user->role }}</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                {{-- <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="ni ni-html5 text-danger text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                                        <p class="text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-danger">Order</span>
                                        <span class="badge badge-sm bg-gradient-danger">#1832412</span>
                                    </div>
                                </div> --}}
                                {{-- <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="ni ni-cart text-info text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                                        <p class="text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-info">Server</span>
                                        <span class="badge badge-sm bg-gradient-info">Payments</span>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="ni ni-credit-card text-warning text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order
                                            #4395133</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                                        <p class="text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-warning">Card</span>
                                        <span class="badge badge-sm bg-gradient-warning">#4395133</span>
                                        <span class="badge badge-sm bg-gradient-warning">Priority</span>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="ni ni-key-25 text-primary text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development
                                        </h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                                        <p class="text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-primary">Development</span>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <span class="timeline-step">
                                        <i class="ni ni-archive-2 text-success text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">New message unread</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">16 DEC</p>
                                        <p class="text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-success">Message</span>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <span class="timeline-step">
                                        <i class="ni ni-check-bold text-info text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Notifications unread</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">15 DEC</p>
                                        <p class="text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <span class="timeline-step">
                                        <i class="ni ni-box-2 text-warning text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">New request</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">14 DEC</p>
                                        <p class="text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-warning">Request</span>
                                        <span class="badge badge-sm bg-gradient-warning">Priority</span>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <span class="timeline-step">
                                        <i class="ni ni-controller text-dark text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Controller issues</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">13 DEC</p>
                                        <p class="text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-dark">Controller</span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                {{-- <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="card bg-gradient-dark">
                        <div class="card-header bg-transparent pb-0">
                            <h6 class="text-white">Timeline dark with dashed line</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="timeline timeline-one-side" data-timeline-axis-style="dashed">
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step bg-dark">
                                        <i class="ni ni-bell-55 text-success text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-white text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                                        <p class="text-secondary text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-success">Design</span>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step bg-dark">
                                        <i class="ni ni-html5 text-danger text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-white text-sm font-weight-bold mb-0">New order #1832412</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                                        <p class="text-secondary text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-danger">Order</span>
                                        <span class="badge badge-sm bg-gradient-danger">#1832412</span>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step bg-dark">
                                        <i class="ni ni-cart text-info text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-white text-sm font-weight-bold mb-0">Server payments for April</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                                        <p class="text-secondary text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-info">Server</span>
                                        <span class="badge badge-sm bg-gradient-info">Payments</span>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step bg-dark">
                                        <i class="ni ni-credit-card text-warning text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-white text-sm font-weight-bold mb-0">New card added for order
                                            #4395133</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                                        <p class="text-secondary text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-warning">Card</span>
                                        <span class="badge badge-sm bg-gradient-warning">#4395133</span>
                                        <span class="badge badge-sm bg-gradient-warning">Priority</span>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step bg-dark">
                                        <i class="ni ni-key-25 text-primary text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-white text-sm font-weight-bold mb-0">Unlock packages for
                                            development</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                                        <p class="text-secondary text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-primary">Development</span>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <span class="timeline-step bg-dark">
                                        <i class="ni ni-archive-2 text-success text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-white text-sm font-weight-bold mb-0">New message unread</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">16 DEC</p>
                                        <p class="text-secondary text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-success">Message</span>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <span class="timeline-step bg-dark">
                                        <i class="ni ni-check-bold text-info text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-white text-sm font-weight-bold mb-0">Notifications unread</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">15 DEC</p>
                                        <p class="text-secondary text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <span class="timeline-step bg-dark">
                                        <i class="ni ni-box-2 text-warning text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-white text-sm font-weight-bold mb-0">New request</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">14 DEC</p>
                                        <p class="text-secondary text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-warning">Request</span>
                                        <span class="badge badge-sm bg-gradient-warning">Priority</span>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <span class="timeline-step bg-dark">
                                        <i class="ni ni-controller text-white"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-white text-sm font-weight-bold mb-0">Controller issues</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">13 DEC</p>
                                        <p class="text-secondary text-sm mt-3 mb-2">
                                            People care about how you see the world, how you think, what motivates you, what
                                            you’re struggling with or afraid of.
                                        </p>
                                        <span class="badge badge-sm bg-gradient-dark">Controller</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>2023,
                                made with <i class="fa fa-heart" aria-hidden="true"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                    Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
@endsection
