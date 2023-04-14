<!-- Modal -->
<div class="modal fade" id="myPModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="font-weight-bolder text-primary text-gradient">Add Property</h3>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        @if(count($errors) > 0)
                            <p class="mb-0">Please input the requirements.</p>
                            @foreach ($errors->all() as $message)
                            <a class="text-danger"><li>{{ $message }}</li></a>
                            @endforeach
                        @else
                        <p class="mb-0">Enter property information</p>
                        @endif
                    </div>
                    <div class="card-body pb-3">
                        <form role="form text-left" method="POST" action="{{ url('/create-property') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col">
                                    <label>Area</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="area" name="area"
                                            placeholder="Area.." aria-label="Area"
                                            aria-describedby="name-addon" value="{{old('area')}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label>garage</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="garage" name="garage"
                                            placeholder="Garage" aria-label="Garage"
                                            aria-describedby="name-addon" value="{{old('garage')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <label>Bathroom</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="bathroom" name="bathroom"
                                    placeholder="Bathroom" aria-label="Bathroom" value="{{old('bathroom')}}">
                            </div>
                                </div>
                                <div class="col">
                                <label>Bedroom</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="bedroom" name="bedroom"
                                    placeholder="Bedroom" aria-label="Bedroom" value="{{old('bedroom')}}">
                            </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <label>Rent</label>
                            <div class="input-group mb-3">
                                <input type="rent" class="form-control" id="rent" name="rent"
                                    placeholder="Rent" aria-label="Rent" value="{{old('rent')}}">
                            </div>
                                </div>
                                <div class="col">
                                <label>City</label>
                            <div class="input-group mb-3">
                                <input type="city" class="form-control" id="city" name="city"
                                    placeholder="City" aria-label="City">
                            </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <label>State</label>
                            <div class="input-group mb-3">
                                <input type="state" class="form-control" id="state" name="state"
                                    placeholder="State" aria-label="State">
                            </div>
                                </div>
                                <div class="col">
                                <label>Address</label>
                            <div class="input-group mb-3">
                                <input type="address" class="form-control" id="address" name="address"
                                    placeholder="Address" aria-label="Address">
                            </div>
                                </div>
                            </div>

                            
                            
                            
                            <label>Description</label>
                            <div class="input-group mb-3">
                                <textarea type="description" class="form-control" id="description" name="description"
                                    placeholder="Description" aria-label="Description"></textarea>
                            </div>

                            <label>Image</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="imagePath" name="imagePath">
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                    class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">{{ __('Add Property') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>