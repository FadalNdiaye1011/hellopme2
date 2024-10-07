@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="flex mb-2">
                <div class="w-full md:w-1/2">
                    <h1 class="text-xl font-bold">
                        Taux et Tarifs | Détail
                    </h1>
                </div>
                <div class="w-full md:w-1/2 flex justify-end">
                    <a class="btn btn-default" href="{{ route('rate-tariffs.index') }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="bg-white shadow rounded-lg p-4">
            <div class="card-body">
                <div class="row">
                    @include('rate_tariffs.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
