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
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="card-header pb-0">
                        <h6>Landlords CRUD</h6>
                        <hr class="horizontal dark mt-0">
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            {{ $dataTable->table(['class' => 'table table-striped table-hover '], true) }}
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </main>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection