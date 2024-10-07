@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="flex justify-between mb-2">
                <div class="w-1/2">
                    <h1 class="text-xl font-semibold">
                        @lang('models/website-links.singular') @lang('crud.detail')
                    </h1>
                </div>
                <div class="w-1/2 text-right">
                    <a class="btn bg-gray-200 text-gray-800 hover:bg-gray-300"
                       href="{{ route('website-links.index') }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="bg-white shadow-md rounded-lg">
            <div class="card-body">
                <div class="row">
                    @include('website_links.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
