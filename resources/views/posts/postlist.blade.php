@extends('layouts.comheader')
@section('content')
<div class="col-sm-12">
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>    
          <strong>{{ $message }}</strong>
      </div>
    @endif
</div>
<h3 style="margin-left: 201px;" class="text-primary">Post List</h3>
<div class="container">
	<form action="/search" method="get" id="selectform">
	 <input  type="text" class="is-invalid" name="title_search" id="title_search" value="{{ isset($request->title_search) ? $request->title_search : ''}}" placeholder="Search By Title">
   <input  type="text" class="is-invalid" name="des_search" id="des_search" value="{{ isset($request->des_search) ? $request->des_search : ''}}" placeholder="Search By Description">
	 <button type="submit" class="btn btn-primary">Search</button>
	 <button type="button" onclick="window.location='{{ url("/posts") }}'" class="btn btn-primary">Add</button>
	 <button type="button" onclick="window.location='{{ url("/uploadview") }}'" class="btn btn-primary">Upload</button>
	 <button type="button" onclick="window.location='{{ url("/export") }}'" class="btn btn-primary">Download</button>
	 </form>
</div>
<br>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Detail Screen </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" wire:model="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="description" class="form-control" id="description" wire:model="description">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" wire:model="status">
                    </div>
                    <div class="form-group">
                        <label for="created_at">Created_At</label>
                        <input type="text" class="form-control" id="created_at" wire:model="created_at">
                    </div>
                    <div class="form-group">
                        <label for="created_user_id">Created_User</label>
                        <input type="text" class="form-control" id="created_user_id" wire:model="created_user_id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <form id="userForm" action="">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Post Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to delete?
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <table class="table table-bordered">
  	<thead>
	    <tr>
	      <th scope="col">Post Title</th>
	      <th scope="col">Post Description</th>
	      <th scope="col">Posted User</th>
	      <th scope="col">Posted Date</th>
          @if( Auth::user()->type != 2 )
	      <th scope="col">Edit Post</th>
	      <th scope="col">Delete Post</th>
          @endif
	    </tr>
  	</thead>
  	<tbody>
  		@foreach($posts as $post)
        @if($post->status == 1)
	    <tr class="table-active" data-toggle="tooltip" data-placement="top" title="This Post is Active Post">
        @else
        <tr>
        @endif
	      <th scope="row"><a class="btn btn-link" id="postdetail" href="" data-toggle="modal" data-target="#exampleModal" data-id="{{ $post->id }}">{{ $post->title }}</a></th>
	      <td>{{ $post->description }}<span class="glyphicon glyphicon-trash"></span></td>
	      <td>ddddddd</td>
	      <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</td>
          @if( Auth::user()->type != 2 )
	      <td><a class="btn btn-outline-info" href="/createpost/{{$post->id}}">Edit</a></td>
        <td><a class="btn btn-outline-danger" data-id="{{ $post->id }}" id="deleteModal" data-toggle="modal" data-target="#exampleModalCenter">Delete</a></td>
          @endif
        <input type="hidden" class="form-control title_{{$post->id}}" id="title" value = "{{ $post->title }}" wire:model="title">
        <input type="hidden" class="form-control des_{{$post->id}}" id="description" value = "{{ $post->description }}" wire:model="description">
        <input type="hidden" class="form-control status_{{$post->id}}" id="status" value = "{{ $post->status }}" wire:model="status">
        <input type="hidden" class="form-control created_at_{{$post->id}}" id="created_at" value = "{{ $post->created_at }}" wire:model="created_at">
        <input type="hidden" class="form-control created_user_{{$post->id}}" id="create_user_id" value = "{{ $post->name}}" wire:model="created_user_id">
	    </tr>
	     @endforeach
  </tbody>
</table>
</div>
<div class="d-flex justify-content-center">
	{{ $posts->withQueryString()->links() }}
</div>
@endsection  