@extends('layouts.app')

@section('content')
    <section class="bg-white py-8">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold">
                    Create Finances
                </h1>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-6">

        {{-- Affiche les erreurs si présentes --}}
        @include('adminlte-templates::common.errors')

        <div class="bg-white shadow rounded-lg p-6">

            {!! Form::open(['route' => 'finances.store', 'enctype' => 'multipart/form-data']) !!}

            <div class="space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @include('prescripteurs.fields')
                    @include('finances.fields')
                </div>

            </div>

            <div class="mt-6 flex justify-end space-x-4">
                {!! Form::submit('Save', ['class' => 'bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded']) !!}
                <a href="{{ route('finances.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
