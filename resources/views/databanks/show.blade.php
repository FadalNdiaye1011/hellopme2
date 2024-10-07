@extends('layouts.app')

@section('content')
<section class="py-4 px-4 mx-4 bg-gray-100">
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <div class="text-lg font-semibold">
                <h1>Databank @lang('crud.detail')</h1>
            </div>
            <div>
                <a class="btn bg-gray-300 hover:bg-gray-400 text-black py-2 px-4 rounded"
                   href="{{ route('databanks.index') }}">
                    @lang('crud.back')
                </a>
            </div>
        </div>
    </div>
</section>

<div class="px-4 py-3">
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-4">
            <div class="grid grid-cols-1 gap-4">
                @include('databanks.show_fields')
            </div>
        </div>
    </div>
</div>

@endsection
