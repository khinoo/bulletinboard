@extends('layouts.comheader')
@section('content')
    <div class="container">
        <div class="row">
            @if(!isset($title))
            <h4>Create Post</h4>
            @else
            <h4>Update Post</h4>
            @endif
        </div>
        <div class="row">
            <form action="/confirm" method="post" id="selectform">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif
                <div class="form-group row">
                    <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                    <label for="title"  class="col-md-4 col-form-label text-md-right">Title</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" value="{{ isset($title) ? $title : '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                    <div class="col-md-8">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="description">{{ isset($description) ? $description : '' }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                 @if(isset($title))
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
                <button type="submit" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-light" onclick="document.getElementById('selectform').reset(); document.getElementById('title').value = null; document.getElementById('description').value = null; return false;">Clear</button>
            </form>
        </div>
    </div>
@endsection