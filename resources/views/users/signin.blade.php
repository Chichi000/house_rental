<div class="modal fade" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-info text-gradient">Welcome to Rental Property!</h3>
                        <p class="mb-0">Enter your email and password to sign in</p>
                    </div>
                    <div class="card-body">
                        <form role="form text-left" action="{{ route('user.signin') }}" method="post">
                            {{ csrf_field() }}
                            <label>Email</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" aria-label="Email" aria-describedby="email-addon"
                                    value="{{ old('email') }}">
                            </div>
                            <label>Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Sign in</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <p class="mb-4 text-sm mx-auto">
                            Don't have an account?
                            <a href="javascript:;" class="text-info text-gradient font-weight-bold"
                                data-bs-dismiss="modal" aria-label="Close" data-bs-toggle='modal'
                                data-bs-target='#myTModal'>Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
