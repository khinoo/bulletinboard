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
                                <h3 class="text-center font-weight-light my-4 text-primary">Create Post Confirmation</h3>
                                @else
                                <h3 class="text-center font-weight-light my-4 text-primary">Update Post Confirmation</h3>
                                @endif
                            </div>
                            <div class="card-body">  
                            <form action="/createpost" method="post" id="selectform">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    Please fix the following errors
                                </div>
                            @endif

                            <div class="form-group row">
                                <input type="hidden" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="id" value="{{ isset($id) ? $id : '' }}">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Post Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ isset($title) ? $title : '' }}" required placeholder="Enter Post Title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Post Description') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="description">{{ isset($description) ? $description : '' }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if($id != null)
                            <div class="row">
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

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    @if($id != null)
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                    @endif
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