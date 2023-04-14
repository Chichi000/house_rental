<div class="modal fade" id="editLandlordModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="font-weight-bolder text-primary text-gradient">Edit Profile</h3>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        @if (count($errors) > 0)
                            <p class="mb-0">Please input the requirements.</p>
                            @foreach ($errors->all() as $message)
                                <a class="text-danger">
                                    <li>{{ $message }}</li>
                                </a>
                            @endforeach
                        @else
                            <p class="mb-0">Enter your personal information here.</p>
                        @endif
                    </div>
                    <div class="card-body pb-3">
                        {{ Form::model($landlord,['route' => ['landlord.update',$landlord->id], 'method'=>'PUT', 'enctype' =>'multipart/form-data']) }}
                        @foreach($users as $user)    
                        <div class="row">
                                <div class="col">
                                    <label>First Name</label>
                                    <div class="input-group mb-3">
                                        {!! Form::text('first_name',$user->landlords->first_name,array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Last Name</label>
                                    <div class="input-group mb-3">
                                        {!! Form::text('last_name',$user->landlords->last_name,array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                            <label>Phone</label>
                            <div class="input-group mb-3">
                                {!! Form::text('phone',$user->landlords->phone,array('class' => 'form-control')) !!}
                            </div>
                            <label>Address</label>
                            <div class="input-group mb-3">
                                {!! Form::text('address',$user->landlords->address,array('class' => 'form-control')) !!}
                            </div>
                            <label>Email</label>
                            <div class="input-group mb-3">
                                {!! Form::text('email',$user->email,array('class' => 'form-control')) !!}
                            </div>
                            <label>Old Password <small>Required</small></label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="old_password" name="old_password"
                                    placeholder="Password" aria-label="Password">
                            </div>

                            <label>New Password <small>Optional</small></label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Password" aria-label="Password">
                            </div>

                            <label>Confrim Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                    placeholder="Password" aria-label="Password">
                            </div>

                            <label>Image <small>Optional</small></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="imagePath" name="imagePath">
                            </div>

                            <div class="float-right">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                            </div>
                        </form>
                        {!! Form::close() !!} 
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
