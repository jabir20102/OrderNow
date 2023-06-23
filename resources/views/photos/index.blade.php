@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Restaurant Photos') }}
    </h2>
@endsection

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Manage Photos') }}</div> --}}

                    <div class="card-body">
                        <form action="{{ route('restaurant.photos.store', $restaurant) }}" method="POST" enctype="multipart/form-data">
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

                        <h4>{{ __('Photos') }}</h4>
                        <div class="row">
                            @foreach($photos as $photo)
                                <div class="col-md-4 mt-3">
                                    <div class="card">
                                        <a href="#" class="photo-link" data-images="{{ json_encode($photo->restaurant->photos->pluck('image')) }}">
                                            <img src="{{ asset('storage/' . $photo->url) }}" class="card-img-top" alt="Photo">
                                        </a>
                                        <div class="card-body">
                                            <form action="{{ route('restaurant.photos.destroy', $photo) }}" method="POST">
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
