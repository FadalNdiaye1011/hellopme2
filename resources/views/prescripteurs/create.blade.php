@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="text-xl font-semibold">
                        Create Prescripteurs
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="bg-white shadow-md rounded-lg p-4">

            {!! Form::open(['route' => 'prescripteurs.store', 'enctype' => 'multipart/form-data']) !!}

            <div class="card-body">
                <div class="row">
                    @include('prescripteurs.fields')
                </div>
            </div>

            <div class="card-footer flex justify-end">
                {!! Form::submit('Save', ['class' => 'bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600']) !!}
                <a href="{{ route('prescripteurs.index') }}" class="ml-2 bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
