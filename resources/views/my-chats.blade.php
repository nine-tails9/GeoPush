@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            @csrf
        <master :id = {{ Auth::user()->id}}></master>
        </div>
    </div>
@endsection