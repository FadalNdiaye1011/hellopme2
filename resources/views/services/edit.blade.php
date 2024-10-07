@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container mx-auto px-4">
            <div class="mb-4">
                <h1 class="text-2xl font-bold">
                    Edit Service
                </h1>
            </div>
        </div>
    </section>

    <div class="content px-4">
        @include('adminlte-templates::common.errors')

        <div class="bg-white shadow rounded-lg p-6">
            {!! Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'patch']) !!}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @include('services.fields')
            </div>

            <div class="mt-6">
                {!! Form::submit('Save', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) !!}
                <a href="{{ route('services.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black font-semibold py-2 px-4 rounded ml-2">Cancel</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
