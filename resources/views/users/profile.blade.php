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
                                <h3 class="text-center font-weight-light my-4 text-primary">User Profile</h3>
                                <a class="btn btn-link" href="/createuser/{{$user->id}}">Edit</a>
                            </div>
                            <div class="card-body">  
                            <form action="/confirm" method="post" id="selectform">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    Please fix the following errors
                                </div>
                            @endif

                            @if($filename != null)
                            <img src="images/{{ $filename }}" style="margin-left: 100px;" alt="profile Pic" height="200" width="200">
                            @endif
                            <br><br>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($user->name) ? $user->name : '' }}" disabled="true">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($user->email) ? $user->email : '' }}" disabled="true">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type"  class="col-md-4 col-form-label text-md-right">Type</label>
                                @if($user->type =='0')         
                                    @php
                                        $type = "Admin";
                                    @endphp         
                                @else
                                    @php
                                        $type = "User";
                                    @endphp       
                                @endif
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ isset($type) ? $type : '' }}" disabled="true">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"  class="col-md-4 col-form-label text-md-right">Phone</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ isset($user->phone) ? $user->phone : '' }}" disabled="true">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob"  class="col-md-4 col-form-label text-md-right date">Date Of Birth</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror datepicker" id="dateofbirth" name="dob" value="{{ isset($user->dob) ? $user->dob : '' }}" disabled="true">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" disabled>{{ isset($user->address) ? $user->address : '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 offset-md-4">
                                    <button type="button" class="btn btn-light"><a href="javascript:history.back()">
                                        {{ __('Cancel') }}</a>
                                    </button>
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