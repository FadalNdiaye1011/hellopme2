@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-12">
                    <h1 class="text-2xl font-bold">
                        Assignation
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('flash::message')

        <div class="bg-white shadow-lg rounded-lg p-6">
            {!! Form::open(['route' => 'assignRoleToUser']) !!}
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Titre Field -->
                    <div>
                        {!! Form::label('user', 'Utilisateur:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                        {!! Form::select('user_id', $users->pluck('first_name', 'id'), null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4', 'placeholder' => 'Choisir un utilisateur', 'required']) !!}
                    </div>

                    <!-- Type Field -->
                    <div>
                        {!! Form::label('role', 'Role:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                        {!! Form::select('role_id[]', $roles->pluck('name', 'id'), null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4', 'placeholder' => 'Choisir un role', 'required']) !!}
                    </div>
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                {!! Form::submit('Save', ['class' => 'bg-blue-600 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-blue-700 transition duration-200']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        {{--
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div>
                <h1 class="text-xl font-semibold">Création role</h1>
                <div class="bg-white shadow-lg rounded-lg p-4">
                    {!! Form::open(['route' => 'roles.store']) !!}
                    <div class="space-y-4">
                        <div>
                            {!! Form::label('name', 'Nom du role:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                            {!! Form::text('name', null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500', 'required']) !!}
                        </div>
                        <div>
                            {!! Form::label('permission', 'Permission:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                            {!! Form::select('permissions[]', $permissions->pluck('name', 'name'), null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500', 'multiple' => 'multiple']) !!}
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        {!! Form::submit('Save', ['class' => 'bg-blue-600 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-blue-700 transition duration-200']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div>
                <h1 class="text-xl font-semibold">Création permission</h1>
                <div class="bg-white shadow-lg rounded-lg p-4">
                    {!! Form::open(['route' => 'permissions.store']) !!}
                    <div class="space-y-4">
                        <div>
                            {!! Form::label('permission', 'Permission:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
                            {!! Form::text('name', null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500', 'required']) !!}
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        {!! Form::submit('Save', ['class' => 'bg-blue-600 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-blue-700 transition duration-200']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        --}}
    </div>
@endsection
