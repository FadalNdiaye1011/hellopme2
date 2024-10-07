@extends('layouts.app')

@section('content')
    <section class="bg-white p-4 m-4">
        <div class="container mx-auto">
            <div class="flex flex-wrap mb-4">
                <div class="w-full">
                    <h1 class="text-xl font-semibold">
                        Create Users
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4">

        @include('adminlte-templates::common.errors')

        <div class="bg-white shadow-md rounded-lg overflow-hidden">

            {!! Form::open(['route' => 'users.store', 'class' => 'p-6']) !!}

            <div class="card-body">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @include('users.fields')
                </div>
            </div>

            <div class="p-4 border-t">
                {!! Form::submit('Save', ['class' => 'bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600']) !!}
                <a href="{{ route('users.index') }}" class="ml-4 bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
