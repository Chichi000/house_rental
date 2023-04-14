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
            <div class="card card-body" id="profile">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-4">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset(Auth::user()->admins->imagePath) }}" alt="bruce"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                {{ Auth::user()->name }} (#{{ Auth::user()->admins->id }})
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                Landlord Verification
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                     
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Transaction Table</h6>
                            <p class="text-sm">
                                <b class="text-danger">Notes:</b> "Please note that once the order status is updated to 'accepted' or 'canceled', it cannot be changed back to 'pending'. Please carefully consider your decision before proceeding."
                            </p>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                ID
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Landlord
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Admin
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Contact No.
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Reference Number
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date Requested
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Update Status
                                            </th>
                                            {{-- <th class="text-secondary opacity-7"></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($verifications as $verification)
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $verification->id }}</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset($verification->imagePath) }}"
                                                                class="avatar avatar-sm me-3">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-xs">{{ $verification->first_name }},
                                                                {{ $verification->last_name }} (#{{ $verification->landlord_id }})</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $verification->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset($transaction->property_image) }}"
                                                                class="avatar avatar-sm me-3">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-xs">{{ $transaction->city }},
                                                                {{ $transaction->state }}
                                                            </h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $transaction->address }}</p>
                                                        </div>
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $verification->admin_id }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $verification->contact_no }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $verification->reference_number }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($verification->status == 'Pending')
                                                        <span class="badge badge-sm badge-primary">{{ $verification->status }}</span>
                                                    @elseif($verification->status == 'Accepted')
                                                        <span
                                                            class="badge badge-sm badge-success">{{ $verification->status }}</span>
                                                    @elseif($verification->status == 'Denied')
                                                        <span
                                                            class="badge badge-sm badge-danger">{{ $verification->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{-- {{ $transaction->created_at->format('m/d/Y - h:i A') }} --}}
                                                        {{ date('m/d/Y - h:i A', strtotime($verification->created_at)) }}
                                                    </span>
                                                </td>
                                                <td class="">
                                                    <form
                                                        action="{{ action('AdminController@editStatus', $verification->id) }}"
                                                        method="post" role="form">
                                                        @csrf

                                                        <div class="btn-group dropstart mt-3">
                                                            <button type="button"
                                                                class="btn btn-sm btn-secondary dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Edit
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <button type="button" class="dropdown-item"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#acceptModal{{ $verification->id }}">
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style="color: #00b815;"></i>
                                                                        Accept
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="dropdown-item"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#cancelModal{{ $verification->id }}">
                                                                        <i class="fa-solid fa-ban"
                                                                            style="color: #dc2e2e;"></i> Denied
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <!-- Accept confirmation modal -->
                                                        <div class="modal fade" id="acceptModal{{ $verification->id }}"
                                                            tabindex="-1" aria-labelledby="acceptModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="acceptModalLabel">
                                                                            Confirm Accept
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to accept this request?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn bg-gradient-secondary"
                                                                            data-bs-dismiss="modal">No</button>
                                                                        <button type="submit" name="status"
                                                                            value="Accepted"
                                                                            class="btn bg-gradient-primary">Yes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Cancel confirmation modal -->
                                                        <div class="modal fade" id="cancelModal{{ $verification->id }}"
                                                            tabindex="-1" aria-labelledby="cancelModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="cancelModalLabel">
                                                                            Confirm Cancel
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to denied this request?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn bg-gradient-secondary"
                                                                            data-bs-dismiss="modal">No</button>
                                                                        <button type="submit" name="status"
                                                                            value="Canceled"
                                                                            class="btn bg-gradient-danger">Yes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach   
                                    </tbody>
                                </table>

                            </div>
                            <div class="ml-3">
                                {{ $verifications->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </main>

    {{-- @include('partials.footer') --}}
@endsection
