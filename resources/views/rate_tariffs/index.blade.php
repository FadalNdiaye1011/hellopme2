@extends('layouts.app')

@section('content')
   <!-- title ici -->

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('rate_tariffs.table')
        </div>
    </div>

@endsection
