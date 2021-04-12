@extends('layouts.comheader')
@section('content')
    <div class="container">
        <div class="row">
            @if($id == null)
            <h4>Create Post Confirmation</h4>
            @else
            <h4>Update Post Confirmation</h4>
            @endif
        </div>
        <div class="row">
            <form action="/createpost" method="post">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif
                <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                <div class="row">
                    <div class="col">
                        <label for="title"  class="col-form-label text-md-right">Title</label>
                    </div>
                    <div class="col">
                      <label for="title" class="col-form-label text-md-right">{{ $title }}</label>
                      <input type="hidden" id="title" name="title" value="{{ $title }}">
                  </div>
                </div>
                 <div class="row">
                    <div class="col">
                        <label for="description" class="col-form-label text-md-right">Description</label>
                    </div>
                    <div class="col">
                      <label for="description"   class="col-form-label text-md-right">{{ $description }}</label>
                      <input type="hidden" name="description" id="description" value="{{ $description }}">
                  </div>
                </div>
                @if($id != null)
                 <div class="form-group row">
                    <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                    <div class="col-md-8">
                        @if($status == 1 )
                        <input type="checkbox" name="status" id="status" checked>
                        @else
                        <input type="checkbox" name="status" id="status">
                        @endif
                    </div>
                </div>
                 @endif
                 @if($id != null)
                <button type="submit" class="btn btn-primary">Update</button>
                @else
                <button type="submit" class="btn btn-primary">Create</button>
                @endif
                <button type="button" class="btn btn-light"><a href="javascript:history.back()">Cancel</a></button>
            </form>
        </div>
    </div>
@endsection