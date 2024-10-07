@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container mx-auto mb-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold">
                    Create Secteur Activites
                </h1>
            </div>
        </div>
    </section>

    <div class="content mx-auto px-4">

        @include('adminlte-templates::common.errors')

        <div class="bg-white shadow-md rounded-lg p-4">

            {!! Form::open(['route' => 'secteur-activites.store']) !!}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @include('secteur_activites.fields')
            </div>

            <div class="flex justify-end mt-4">
                {!! Form::submit('Save', ['class' => 'bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600']) !!}
                <a href="{{ route('secteur-activites.index') }}" class="ml-2 bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
