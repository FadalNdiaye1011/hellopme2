@extends('layouts.app')

@section('content')

<div class="bg-gray-100  transition-colors duration-300">
    <div class="container mx-auto p-4">
        @include('adminlte-templates::common.errors')
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-[#677B44]">Modifier l'opportunité</h1>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Veuillez fournir les informations de l'opportunité.</p>
            {!! Form::model($databanks, ['route' => ['databanks.update', $databanks->id], 'method' => 'patch', 'id' => 'databankForm']) !!}
                @include('databanks.fields')
                <div class="flex justify-end space-x-4">
                    {!! Form::submit('Enregistrer', ['class' => 'px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition-colors', 'id' => 'saveButton']) !!}
                    <a href="{{ route('databanks.cancel', $databanks->id) }}" class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600" id="cancelButton">
                        Annuler
                    </a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<!-- 

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
