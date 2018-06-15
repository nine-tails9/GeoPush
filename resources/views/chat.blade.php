@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            @csrf
            
            <div class="col-md-8">

                <div class="card"> 
                    <div class="card-header">Messages</div>

                    <div class="card-body">

                    <chat-messages :user = "{{Auth::User()}}">
                        </chat-messages>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection