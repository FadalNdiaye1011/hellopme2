@extends('layouts.app')

@section('content')


    <!-- <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 px-6 flex items-center justify-between">
            <div class="col-sm-6">
            </div>
            <a href="{{ route('services.create') }}" class="flex justify-end">
                <button
                    class="flex items-center border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    style="background-color: #5865F2;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" width="800px" height="800px" viewBox="0 0 24 24" fill="#FFFFFF">
                        <path d="M4 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM11 11H7V13H11V17H13V13H17V11H13V7H11V11Z"></path>
                    </svg>

                    <span>Add New</span>

                </button>
            </a>
        </div>
    </div>
</section> -->

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('services.table')
        </div>
    </div>

@endsection
