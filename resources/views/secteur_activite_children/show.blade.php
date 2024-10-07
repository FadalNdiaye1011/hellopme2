@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container mx-auto mb-4">
            <div class="flex justify-between items-center mb-2">
                <div class="flex-1">
                    <h1 class="text-xl font-semibold">
                        Secteur Activite Children | @lang('crud.detail')
                    </h1>
                </div>
                <div>
                    <a class="btn btn-default"
                       href="{{ route('secteur-activite-children.index') }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content mx-auto px-4">
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="card-body">
                <div class="row">
                    @include('secteur_activite_children.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
