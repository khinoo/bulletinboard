@extends('layouts.comheader')
@section('content')
    <div class="container">
        <div class="row">
            @if($id == null)
            <h4>Create User Confirmation</h4>
            @else
            <h4>Update User Confirmation</h4>
            @endif
        </div>
        <div class="row">
            <form action="/createuser" method="post" id="selectform">
                @csrf
                <img src="images/{{ $filename }}">
                <div class="form-group row">
                    <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                    <label for="name"  class="col-md-4 col-form-label text-md-right">Name</label>
                    <label for="name"  class="col-md-4 col-form-label text-md-right">{{ $name }}</label>
                    <input type="hidden" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="name" value="{{ isset($name) ? $name : '' }}">
                </div>
                <div class="form-group row">
                    <label for="email"  class="col-md-4 col-form-label text-md-right">Email Address</label>
                    <label for="email"  class="col-md-4 col-form-label text-md-right">{{ $email }}</label>
                    <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email" value="{{ isset($email) ? $email : '' }}">
                </div>
                @if($id == null)
                <div class="form-group row">
                    <label for="password"  class="col-md-4 col-form-label text-md-right">Password</label>
                     <label for="password"  class="col-md-4 col-form-label text-md-right">{{ $password }}</label>
                    <input type="hidden" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password" value="{{ isset($password) ? $password : '' }}">
                </div>
                <div class="form-group row">
                    <label for="confirmpsw"  class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                    <label for="confirmpsw"  class="col-md-4 col-form-label text-md-right">{{ $confirmpsw }}</label>
                    <input type="hidden" class="form-control @error('confirmpsw') is-invalid @enderror" id="confirmpsw" name="confirmpsw" placeholder="confirmpsw" value="{{ isset($confirmpsw) ? $confirmpsw : '' }}">
                </div>
                @endif
                <div class="form-group row">
                    <input type="hidden" class="form-control @error('type') is-invalid @enderror" id="type" name="type" placeholder="type" value="{{ isset($type) ? $type : '' }}">
                    <label for="type"  class="col-md-4 col-form-label text-md-right">Type</label>
                    <label for="type"  class="col-md-4 col-form-label text-md-right">{{ $type }}</label>
                </div>
                <div class="form-group row">
                    <label for="phone"  class="col-md-4 col-form-label text-md-right">Phone</label>
                    <label for="phone"  class="col-md-4 col-form-label text-md-right">{{ $phone }}</label>
                    <input type="hidden" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="phone" value="{{ isset($phone) ? $phone : '' }}">
                </div>
               <div class="form-group row">
                    <input type="hidden" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" placeholder="dob" value="{{ isset($dob) ? $dob : '' }}">
                    <label for="dob"  class="col-md-4 col-form-label text-md-right date">Date Of Birth</label>
                    <label for="dob"  class="col-md-4 col-form-label text-md-right">{{ date('Y/m/d', strtotime($dob)) }}</label>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                    <label for="address"  class="col-md-4 col-form-label text-md-right">{{ $address }}</label>
                    <input type="hidden" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="address" value="{{ isset($address) ? $address : '' }}">
                    <input type="hidden" class="form-control @error('filename') is-invalid @enderror" id="filename" name="filename" placeholder="filename" value="{{ isset($filename) ? $filename : '' }}">
                </div>
                @if($id != null)
                <button type="submit" class="btn btn-primary">Update</button>
                @else
                <button type="submit" class="btn btn-primary">Create</button>
                @endif
                <button type="button" class="btn btn-light"><a href="javascript:history.back()">Cancel</a></button>
            </form>
        </div>
    </div>
</body>
</html>
@endsection