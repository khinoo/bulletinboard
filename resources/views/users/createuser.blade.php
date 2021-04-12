@extends('layouts.comheader')
@section('content')
    <div class="container">
        <div class="row">
            @if($id == null)
            <h4>Create User</h4>
            @else
            <h4>Update User</h4>
            @endif
        </div>
        <div class="row">
            <form action="/userconfirm" method="post" id="selectform" enctype="multipart/form-data">
                @csrf
                @if($id != null)
                <img src="../images/{{ $filename }}">
                @endif
                <div class="form-group row">
                    <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                    <label for="name"  class="col-md-4 col-form-label text-md-right">Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="name" value="{{ isset($name) ? $name : '' }}">
                    </div>
                    <div class="col">
                        <label style="color: red;">*</label>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                    <label for="email"  class="col-md-4 col-form-label text-md-right">Email Address</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email" value="{{ isset($email) ? $email : '' }}">
                    </div>
                    <div class="col">
                        <label style="color: red;">*</label>
                    </div>
                </div>
                 @if($id == null)
                <div class="form-group row">
                    <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                    <label for="password"  class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password" value="{{ isset($password) ? $password : '' }}">
                    </div>
                    <div class="col">
                        <label style="color: red;">*</label>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                    <label for="confirmpsw"  class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control @error('confirmpsw') is-invalid @enderror" id="confirmpsw" name="confirmpsw" placeholder="confirmpsw" value="{{ isset($confirmpsw) ? $confirmpsw : '' }}">
                    </div>
                    <div class="col">
                        <label style="color: red;">*</label>
                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
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
                    <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                    <div class="col-md-6">
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="address">{{ isset($address) ? $address : '' }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                <button type="submit" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-light" onclick="document.getElementById('selectform').reset();">Clear</button>
            </form>
        </div>
    </div>
@endsection