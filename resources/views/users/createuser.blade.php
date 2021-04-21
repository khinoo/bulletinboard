@extends('layouts.comheader')
@section('content')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                @if($id == null)
                                <h3 class="text-center font-weight-light my-4 text-primary">Create User</h3>
                                @else
                                <h3 class="text-center font-weight-light my-4 text-primary">Update User</h3>
                                @endif
                            </div>
                            <div class="card-body">  
                            <form action="/userconfirm" method="post" id="selectform" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    Please fix the following errors
                                </div>
                            @endif

                            @if($id != null && $filename != null)
                            <img src="../images/{{ $filename }}" style="margin-left: 100px;" alt="profile Pic" height="200" width="200">
                            @endif
                            <br><br>

                            <div class="form-group row">
                                <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($name) ? $name : '' }}" required placeholder="Enter User Name" autofocus>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($email) ? $email : '' }}" required placeholder="Enter User Name" autofocus>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label>
                                </div>
                            </div>

                            @if($id == null)
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ isset($password) ? $password : '' }}" required autofocus>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="confirmpsw" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="confirmpsw" type="password" class="form-control @error('confirmpsw') is-invalid @enderror" name="confirmpsw" value="{{ isset($confirmpsw) ? $confirmpsw : '' }}" required>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label>
                                </div>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label for="type"  class="col-md-4 col-form-label text-md-right">Type</label>
                                <div class="col-md-6">
                                    <select id="type" required="" name="type" class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                        <option value="Visitor">Visitor</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                                <label for="phone"  class="col-md-4 col-form-label text-md-right">Phone</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="phone" value="{{ isset($phone) ? $phone : '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                                <label for="dob"  class="col-md-4 col-form-label text-md-right date" id="datepicker">Date Of Birth</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" placeholder="dob" value="{{ isset($dob) ? $dob : '' }}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter Address">{{ isset($address) ? $address : '' }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profile" class="col-md-4 col-form-label text-md-right">Profile</label>
                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label>
                                </div>
                                <input type="hidden" name="filename" value="{{$filename}}">
                            </div>
                             @if($id != null)
                            <div class="form-group row">
                            <a class="btn btn-link" href="/changepassword/{{$id}}">Change Password</a>
                            </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-16 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm') }}
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('selectform').reset(); document.getElementById('title').value = null; document.getElementById('description').value = null; return false;">
                                        {{ __('Clear') }}
                                    </button>
                                    <a href="javascript:history.back()"><button type="button" class="btn btn-light">{{ __('Cancel') }}</button></a>
                                </div>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection