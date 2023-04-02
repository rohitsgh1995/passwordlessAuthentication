@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="m-0">{{ config('app.name') }}</h2>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
                                                                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <h3>Dashboard</h3>
                    <br>
                    Welcome {{ Auth::user()->name }}
                    <br><br>
                    Great to see you.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
