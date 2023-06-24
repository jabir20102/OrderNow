@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Restaurant Details') }}
    </h2>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                        <form method="POST" action="{{ route('restaurants.update', $restaurant) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name"
                                    >{{ __('Name') }}</label>

                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $restaurant->name }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="description"
                                    >{{ __('Description') }}</label>

                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ $restaurant->description }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="address"
                                    >{{ __('Address') }}</label>

                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ $restaurant->address }}" required>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="contact"
                                    >{{ __('Contact') }}</label>

                                    <input id="contact" type="text"
                                        class="form-control @error('contact') is-invalid @enderror" name="contact"
                                        value="{{ $restaurant->contact }}" required>

                                    @error('contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
