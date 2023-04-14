<!-- Button trigger modal -->
{{-- <button type="button" class="btn bg-gradient-info btn-block" data-bs-toggle="modal" data-bs-target="#exampleModalSignUp">
      SignUp Modal
    </button> --}}

<!-- Modal -->
<div class="modal fade" id="myTModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="font-weight-bolder text-primary text-gradient">Register as Tenant</h3>
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
                        <p class="mb-0">Enter your information to register</p>
                        @endif
                    </div>
                    <div class="card-body pb-3">
                        <form role="form text-left" method="POST" action="{{ url('/register-tenant') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col">
                                    <label>First Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            placeholder="First Name" aria-label="First Name"
                                            aria-describedby="name-addon" value="{{old('first_name')}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Last Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            placeholder="Last name" aria-label="Last name"
                                            aria-describedby="name-addon" value="{{old('last_name')}}">
                                    </div>
                                </div>
                            </div>
                            <label>Phone</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="63+ 9219201772" aria-label="phone" value="{{old('phone')}}">
                            </div>
                            <label>Address</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="#1-B New Lower Example..." aria-label="address" value="{{old('address')}}">
                            </div>
                            <label>Email</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" aria-label="Email" value="{{old('email')}}">
                            </div>
                            <label>Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" aria-label="Password">
                            </div>


                            <label>Image</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="imagePath" name="imagePath">
                            </div>

                            {{-- <div class="form-check form-check-info text-left">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                    checked="">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I agree the <a href="javascrpt:;" class="text-dark font-weight-bolder">Terms and
                                        Conditions</a>
                                </label>
                            </div> --}}
                            <div class="text-center">
                                <button type="submit"
                                    class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">{{ __('Register') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center pt-0 px-sm-4 px-1">
                        <p class="mb-4 mx-auto">
                            Already have an account?
                            <a href="javascrpt:;" class="text-primary text-gradient font-weight-bold" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle='modal' data-bs-target='#signinModal'>Sign in</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
