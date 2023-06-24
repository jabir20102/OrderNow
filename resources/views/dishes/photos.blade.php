@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{  $dish->name}}
    </h2>
@endsection

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Manage Photos') }}</div> --}}

                    <div class="card-body">
                        <form action="{{ route('dishes.photos.store', $dish) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image">{{ __('Upload Photo') }}</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                        </form>

                        <hr>
                        <div class="row">
                            @foreach($dish->photos as $photo)
                                <div class="col-md-4 mt-3">
                                    <div class="card">
                                        <a href="#" class="photo-link" >
                                            <img src="{{ asset('storage/' . $photo->path) }}" class="card-img-top" alt="Photo">
                                        </a>
                                        <div class="card-body">
                                            <form action="{{ route('dishes.photos.destroy', $photo) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm float-right"
                                                    onclick="return confirm('Are you sure you want to delete this photo?')">
                                                    <i class="fa fa-trash"></i> 
                                                </button>
                                            </form>



                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@endsection
