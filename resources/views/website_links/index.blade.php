@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="flex justify-between mb-2">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold">Website Links</h1>
                </div>
                <div>
                    <a class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600"
                       href="{{ route('website-links.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('flash::message')

        <div class="clearfix"></div>

        <div class="bg-white shadow-md rounded-lg p-4">
            @include('website_links.table')
        </div>
    </div>
@endsection
