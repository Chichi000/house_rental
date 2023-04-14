{{-- @extends('layouts.base') --}}
@extends('layouts.master')
@section('content')
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
                    <div class="col-lg-8 col-md-6">
                        <div class="card shadow-sm ">
                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                            <div class="position-relative">
                                <a class="d-block border-radius-xl">
                                    <img src="{{ asset($property->imagePath) }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                {{-- <p class="text-gradient text-dark mb-2 text-sm">
                                  </p> --}}
                                <a href="javascript:;">
                                    <h3>
                                        {{ $property->state }}, {{ $property->city }}
                                    </h3>
                                </a>
                                <p><small>Property Information</small></p>
                                    <p ><strong class="text-gradient text-primary">Price:</strong> ₱{{ number_format($property->rent, 2, '.', ',') }} </p>
                                    <p><strong class="text-gradient text-primary">Description:</strong> {{ $property->description }} </p>
                                    <p><strong class="text-gradient text-primary" >Area:</strong> {{ $property->area }} sqr</p>
                                    <p><strong class="text-gradient text-primary">Garage:</strong> {{ $property->garage }} Garage</p>
                                    <p><strong class="text-gradient text-primary">Bedroom:</strong> {{ $property->bedroom }} Bedroom</p>
                                    <p><strong class="text-gradient text-primary">Bathroom:</strong> {{ $property->bathroom }} Bathroom</p>
                                {{-- <div class="d-flex align-items-center justify-content-between">
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                                    <div class="avatar-group mt-2">
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Peterson" data-original-title="">
                                            <img alt="Image placeholder" src="https://demos.creative-tim.com/soft-ui-dashboard/assets/img/team-4.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Nick Daniel" data-original-title="">
                                            <img alt="Image placeholder" src="https://demos.creative-tim.com/soft-ui-dashboard/assets/img/team-3.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Ryan Milly" data-original-title="">
                                            <img alt="Image placeholder" src="https://demos.creative-tim.com/soft-ui-dashboard/assets/img/team-2.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Elena Morison" data-original-title="">
                                            <img alt="Image placeholder" src="https://demos.creative-tim.com/soft-ui-dashboard/assets/img/team-1.jpg">
                                        </a>
                                    </div>
                                </div> --}}
                                  {{-- <div class="row">
                                    <div class="col-sm"><strong>Garage:</strong> {{ $property->garage }} Garage</div>
                                    <div class="col-sm"><p><strong>Bedroom:</strong> {{ $property->bedroom }} Bedroom</p></div>
                                    <div class="col-sm"><p><strong>Bathroom:</strong> {{ $property->bathroom }} Bathroom</p></div>
                                  </div> --}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        
                        {{ Form::model($property,['route' => ['property.update',$property->id], 'method'=>'PUT', 'enctype' =>'multipart/form-data']) }}
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="mb-0">Edit property </h6>
                                    </div>
                                    <div class="col-4 text-end">
                                        <button type="submit" class="btn btn-sm bg-gradient-primary mb-0">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                    <h6 class="heading-small text-muted mb-4">Property information</h6>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Area</label>
                                                    {!! Form::text('area',$property->area,array('class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Rent</label>
                                                    {!! Form::text('rent',$property->rent,array('class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Garage</label>
                                                    {!! Form::text('garage',$property->garage,array('class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Bathroom</label>
                                                    {!! Form::text('bathroom',$property->bathroom,array('class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-last-name">Bedroom</label>
                                                    {!! Form::text('bedroom',$property->bedroom,array('class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <hr class="horizontal dark my-4"> --}}
                                    <!-- Address -->
                                    {{-- <h6 class="heading-small text-muted mb-4">Contact information</h6> --}}
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-address">Address</label>
                                                    {!! Form::text('address',$property->address,array('class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-city">City</label>
                                                    {!! Form::text('city',$property->city,array('class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-country">State</label>
                                                    {!! Form::text('state',$property->state,array('class' => 'form-control')) !!}
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="image" class="control-label">Change Picture</label>
                                                    <input for="images" type="file" class="form-control" id="imagePath" name="imagePath">
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark my-4">
                                    <!-- Description -->
                                     <h6 class="heading-small text-muted mb-4">About property</h6>
                                    <div>
                                        <div class="form-group">
                                            <label class="form-control-label">Description</label>
                                            {!! Form::textarea('description',$property->description,array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!} 
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
            
            @include('partials.footer')
    </main>
@endsection