@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Messager Application</div>

                <div class="card-body" id="app">
                <chat-app :user="{{ auth()->user() }}"></chat-app>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
