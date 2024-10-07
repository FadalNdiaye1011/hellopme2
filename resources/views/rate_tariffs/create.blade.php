@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="flex mb-2">
                <div class="w-full">
                    <h1 class="text-xl font-bold">
                        Create Taux & Tarifs
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="bg-white shadow rounded-lg p-4">

            {!! Form::open(['route' => 'rate-tariffs.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('rate_tariffs.fields')
                </div>

            </div>

            <div class="flex justify-between p-4 border-t">
                {!! Form::submit('Save', ['class' => 'bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded']) !!}
                <a href="{{ route('rate-tariffs.index') }}" class="bg-gray-300 text-gray-800 hover:bg-gray-400 px-4 py-2 rounded"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
