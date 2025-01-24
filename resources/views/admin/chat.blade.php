@extends('layouts.auth')
@section('page_title','Chat')
@section('content')
    <div class="container-fluid">
        <div class="main-wrapper">
            <chatbox-component :alertId="{{$alertId}}" :userId="{{$userId}}"></chatbox-component>
        </div>
    </div>
        <!-- End Container fluid  -->
@endsection