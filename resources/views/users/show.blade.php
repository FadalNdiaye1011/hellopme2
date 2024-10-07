@extends('layouts.app')

@section('content')
    <section class="bg-gray-100 p-4 mx-4 my-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-700">
                    Utilisateur @lang('crud.detail')
                </h1>
                <a class="btn bg-gray-300 hover:bg-gray-400 text-black py-2 px-4 rounded"
                   href="{{ route('users.index') }}">
                    @lang('crud.back')
                </a>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4">
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="grid grid-cols-1 gap-4">
                    @include('users.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
