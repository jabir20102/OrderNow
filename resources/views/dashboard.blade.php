@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection



@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($orders as $order)
                    <div class="card">
                        <div class="card-body">
                            
                            <h5 class="card-title">Order ID {{$order->id}}</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="card-subtitle mb-2 text-muted">Order Price</h6>
                                    <p class="card-text">{{ $order->price }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="card-subtitle mb-2 text-muted">User Details</h6>
                                    <p class="card-text">John Doe<br>john.doe@example.com</p>
                                    
                                </div>
                            </div>
                            <h6 class="card-subtitle mt-3 mb-2 text-muted">Dishes</h6>
                            <ul class="list-group">
                                @foreach (explode('@', $order->order) as $info)
                                
                               
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $info }}

                                        <span class="badge bg-secondary">$</span>
                                    </li>
                                @endforeach

                            </ul>
                            
                        </div>
                                <button class="btn btn-primary text-end">Dispatch</button>
                              
                    </div>
                @endforeach


            </div>
        </div>
    </div>
@endsection
