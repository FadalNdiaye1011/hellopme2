@extends('layouts.app')

@section('content')
    <section class="content-header mb-4">
        <div class="container-fluid">
            <div class="flex justify-between mb-2">
                <div class="col-sm-6">
                    <h1 class="text-xl font-semibold">
                         @lang('crud.detail')
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-gray-300 float-right"
                       href="{{ route('prescripteurs.index') }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="card-body">
                <div class="row">
                    @include('prescripteurs.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
