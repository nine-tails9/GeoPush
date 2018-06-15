@extends('layouts.app')


@section('content')
    <div class="container">
        @foreach($data as $d)

            {{$d}}
        @endforeach
    </div>
@endsection