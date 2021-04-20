@extends('layouts.comheader')
@section('content')
<div class="col-sm-12">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>
<h3>Post List</h3>
<div class="container">
	<form action="/search" method="get" id="selectform">
	 <input  type="text" class="is-invalid" name="search" id="search" value="" >
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
                <h5 class="modal-title" id="exampleModalLabel">Post Deatail Screen </h5>
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
                        <label for="created_user_id">Created_User_ID</label>
                        <input type="text" class="form-control" id="created_user_id" wire:model="created_user_id">
                    </div>
                    <div class="form-group">
                        <label for="updated_at">Updated_At</label>
                        <input type="text" class="form-control" id="updated_at" wire:model="updated_at">
                    </div>
                    <div class="form-group">
                        <label for="updated_user_id">Updated_User_ID</label>
                        <input type="text" class="form-control" id="updated_user_id" wire:model="updated_user_id">
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
	      <th scope="col">Post Title</th>
	      <th scope="col">Post Description</th>
	      <th scope="col">Posted User</th>
	      <th scope="col">Posted Date</th>
	      <th scope="col"></th>
	      <th scope="col"></th>
	    </tr>
  	</thead>
  	<tbody>
  		@foreach($posts as $post)
	    <tr>
	      <th scope="row"><a class="btn btn-link" id="postdetail" href="" data-toggle="modal" data-target="#exampleModal" data-id="{{ $post->id }}">{{ $post->title }}</a></th>
	      <td>{{ $post->description }}</td>
	      <td>{{ $post->name }}</td>
	      <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</td>
	      <td><a class="btn btn-link" href="/createpost/{{$post->id}}">Edit</a></td>
	      <td><a class="btn btn-link" onclick="return confirm('Are you sure want to delete this post?')" href="/deletepost/{{$post->id}}">Delete</a></td>

        <input type="hidden" class="form-control title_{{$post->id}}" id="title" value = "{{ $post->title }}" wire:model="title">
        <input type="hidden" class="form-control des_{{$post->id}}" id="description" value = "{{ $post->description }}" wire:model="description">
        <input type="hidden" class="form-control status_{{$post->id}}" id="status" value = "{{ $post->status }}" wire:model="status">
        <input type="hidden" class="form-control createdat_{{$post->id}}" id="created_at" value = "{{ $post->created_at }}" wire:model="created_at">
        <input type="hidden" class="form-control created_user_{{$post->id}}" id="created_user_id" value = "{{ $post->name }}" wire:model="created_user_id">
        <input type="hidden" class="form-control updatedat_{{$post->id}}" id="updated_at" value = "{{ $post->updated_at }}" wire:model="updated_at">
        <input type="hidden" class="form-control updateuser_{{$post->id}}" id="updated_user_id" value = "{{ $post->name }}" wire:model="updated_user_id">
	    </tr>
	     @endforeach
  </tbody>
</table>
</div>
<div class="d-flex justify-content-center">
	{{ $posts->links() }}
</div>
@endsection  