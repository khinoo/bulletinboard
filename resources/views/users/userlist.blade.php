@extends('layouts.comheader')
@section('content')
<h3>User List</h3>
<div class="container">
	<form action="/usersearch" method="get" id="selectform">
	 <input id="name" type="" class="is-invalid" name="name" value="" placeholder="Name">
	 <input id="email" type="" class="is-invalid" name="email" value="" placeholder="Email">
	 <input id="createdFrom" type="" class="is-invalid" name="createdFrom" value="" placeholder="CreatedFrome">
	 <input id="createdTo" type="" class="is-invalid" name="createdTo" value="" placeholder="CreatedTo">
	 <button type="submit" class="btn btn-primary">Search</button>
	 <button type="button" onclick="window.location='{{ url("/createuser") }}'" class="btn btn-primary">Add</button>
	</form>
</div>
<br>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Deatail Screen </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" class="form-control" id="username" wire:model="username">
                    </div>
                    <div class="form-group">
                        <label for="useremail">Email</label>
                        <input type="text" class="form-control" id="useremail" wire:model="useremail">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" wire:model="type">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" wire:model="phone">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" wire:model="address">
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="text" class="form-control" id="dob" wire:model="dob">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <table class="table table-bordered">
  	<thead>
	    <tr>
	      <th scope="col">Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Created User</th>
	      <th scope="col">Phone</th>
	      <th scope="col">Birth Date</th>
	      <th scope="col">Address</th>
	      <th scope="col">Created Date</th>
	      <th scope="col">Updated Date</th>
	      <th scope="col"></th>
	      <th scope="col"></th>
	    </tr>
  	</thead>
  	<tbody>
  		@foreach($users as $user)
	    <tr>
	      <th scope="row"><a class="btn btn-link" id="userdetail" href="" data-toggle="modal" data-target="#exampleModal" data-id="{{ $user->id }}">{{ $user->name }}</a></th>
	      <td>{{ $user->email }}</td>
	      <td>{{ $user->create_user_id }}</td>
	      <td>{{ $user->phone }}</td>
	      <td>{{ \Carbon\Carbon::parse($user->dob)->format('d/m/Y')}}</td>
	      <td>{{ $user->address }}</td>
	      <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
	      <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y')}}</td>
	      <td><a class="btn btn-link" href="/createuser/{{$user->id}}">Edit</a></td>
	      <td><a class="btn btn-link" onclick="return confirm('Are you sure want to delete this post?')" href="/deleteuser/{{$user->id}}">Delete</a></td>

	    <input type="hidden" class="form-control name_{{$user->id}}" id="name" value = "{{ $user->name }}" wire:model="name">
        <input type="hidden" class="form-control email_{{$user->id}}" id="email" value = "{{ $user->email }}" wire:model="email">
        <input type="hidden" class="form-control type_{{$user->id}}" id="type" value = "{{ $user->type }}" wire:model="type">
        <input type="hidden" class="form-control phone_{{$user->id}}" id="phone" value = "{{ $user->phone }}" wire:model="phone">
        <input type="hidden" class="form-control address_{{$user->id}}" id="address" value = "{{ $user->address }}" wire:model="address">
        <input type="hidden" class="form-control dob_{{$user->id}}" id="dob" value = "{{ $user->dob }}" wire:model="dob">
	    </tr>
	     @endforeach
  </tbody>
</table>
</div>
<div class="d-flex justify-content-center">
	{{ $users->links() }}
</div>
@endsection