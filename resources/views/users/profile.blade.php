@extends('layouts.comheader')
@section('content')
    <div class="container">
        <div class="row">
            <h4>User Profile</h4>
            <a class="btn btn-link" href="/createuser/{{$user->id}}">Edit</a>
        </div>
        <div class="row">
            <form action="{{ route('confirm') }}" method="post" id="selectform">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif
                <img src="images/{{ $filename }}">
                <div class="row">
                    <label for="name"  class="col-md-4 col-form-label text-md-right">Name</label>
                    <div class="col">
                        <label for="name" class="col-form-label text-md-right">{{ $user->name }}</label>
                        <input type="hidden" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="row">
                    <label for="profile"  class="col-md-4 col-form-label text-md-right"></label>
                    <div class="col">

                    </div>
                </div>
                <div class="row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                    <div class="col">
                        <label for="email" class="col-form-label text-md-right">{{ $user->email }}</label>
                        <input type="hidden" class="form-control @error('profile') is-invalid @enderror" id="profile" profile="profile" placeholder="profile" value="{{ old('profile') }}">
                    </div>
                </div>
                <div class="row">
                    <label for="type"  class="col-md-4 col-form-label text-md-right">Type</label>
                    <div class="col">
                    @if($user->type =='0')         
                        @php
                            $type = "Admin";
                        @endphp         
                    @else
                        @php
                            $type = "User";
                        @endphp       
                    @endif
                        <label for="type" class="col-form-label text-md-right">{{ $type }}</label>
                        <input type="hidden" class="form-control @error('type') is-invalid @enderror" id="type" type="type" placeholder="type" value="{{ old('type') }}">
                    </div>
                </div>
                <div class="row">
                    <label for="phone"  class="col-md-4 col-form-label text-md-right">Phone</label>
                    <div class="col">
                        <label for="phone" class="col-form-label text-md-right">{{ $user->phone }}</label>
                        <input type="hidden" class="form-control @error('phone') is-invalid @enderror" id="phone" phone="phone" placeholder="phone" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="row">
                    <label for="dob"  class="col-md-4 col-form-label text-md-right">Date of Birth</label>
                    <div class="col">
                        <label for="dob" class="col-form-label text-md-right">{{ date('Y/m/d', strtotime($user->dob)) }}</label>
                        <input type="hidden" class="form-control @error('dob') is-invalid @enderror" id="dob" dob="dob" placeholder="dob" value="{{ old('dob') }}">
                    </div>
                </div>
                <div class="row">
                    <label for="address"  class="col-md-4 col-form-label text-md-right">Address</label>
                    <div class="col">
                        <label for="address" class="col-form-label text-md-right">{{ $user->address }}</label>
                        <input type="hidden" class="form-control @error('address') is-invalid @enderror" id="address" address="address" placeholder="address" value="{{ old('address') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection