@extends('layouts.app')

@section('content')
    <section class="content-header mb-4">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="text-2xl font-semibold">Create Website Links</h1>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="bg-white shadow-md rounded-lg p-4">

            {!! Form::open(['route' => 'website-links.store']) !!}

            <div class="card-body">

                <div class="grid grid-cols-1 gap-4">
                    @include('website_links.fields')
                </div>

            </div>

            <div class="card-footer flex justify-between mt-4">
                {!! Form::submit('Save', ['class' => 'bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600']) !!}
                <a href="{{ route('website-links.index') }}" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-400"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
