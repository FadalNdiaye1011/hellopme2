@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-2xl font-bold">
                        Finances | Détail
                    </h1>
                </div>
                <div>
                    <a class="btn btn-secondary bg-gray-300 hover:bg-gray-400 text-black font-semibold py-2 px-4 rounded"
                       href="{{ route('finances.index') }}">
                       @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @include('finances.show_fields')
            </div>
        </div>
    </div>
@endsection
