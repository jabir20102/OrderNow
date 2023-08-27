@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dishes') }}
    </h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="row ">
                    @foreach ($dishes as $dish)
                        <div class="card">
                           <img src="{{ asset('storage/' . $dish->image) }}" 
                                class="card-img-top"
                                style="width: 300px;height: 200px;object-fit: cover;"
                                alt="Dish Photo">
                            <div class="card-body">
                                <h5 class="card-title">{{ $dish->name }}</h5>
                                <p class="card-text">{{ $dish->ingredients }}</p>
                                <p class="card-text">Price: ${{ $dish->price }}</p>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
