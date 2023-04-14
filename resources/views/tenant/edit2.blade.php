@extends('layouts.base')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('partials.navbar')
        <hr class="horizontal dark mt-0">

        <div class="container-fluid py-4">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="card-header pb-0">
                        <h6>Edit Tenant</h6>
                        <hr class="horizontal dark mt-0">
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        {{ Form::model($tenant,['route' => ['tenant.update',$tenant->id], 'method'=>'PUT', 'enctype' =>'multipart/form-data']) }}
                        @foreach($users as $user)
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">First Name</label>
                            {!! Form::text('first_name',$user->tenants->first_name,array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            <label for="example-search-input" class="form-control-label">Last Name</label>
                            {!! Form::text('last_name',$user->tenants->last_name,array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            <label for="example-tel-input" class="form-control-label">Phone</label>
                            {!! Form::text('phone',$user->tenants->phone,array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            <label for="example-email-input" class="form-control-label">Email</label>
                            {!! Form::text('email',$user->email,array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            <label for="example-password-input" class="form-control-label">Password</label>
                            <input class="form-control" type="password" value="password" id="example-password-input">
                        </div>
                        <div class="form-group">
                            <label for="image" class="control-label">Your Picture</label>
                            <input type="file" class="form-control-file" id="image" name="image" required="">
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
            
                            <td><img src="{{ asset($tenant->imagePath) }}" width="80"height="80" class="rounded" >
                            </td>
                        </div> 
                        <div class="row">
                            <div class="form-group col-md-4" style="margin-top:30px">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>
                       {!! Form::close() !!} 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
