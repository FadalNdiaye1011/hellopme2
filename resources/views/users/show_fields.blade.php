@php
$roles = $user->roles;
$role = (isset($roles[0]) ? $roles[0]->name : 'user');
$register_at = ($user->created_at) ? \Carbon\Carbon::parse($user->created_at)->formatLocalized('%d %B %Y') : 'None';
@endphp

<!-- First Name Field -->
<div class="w-full mb-4">
    {!! Form::label('first_name', 'Prénom :', ['class' => 'block font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $user->first_name }}</p>
</div>

<!-- Last Name Field -->
<div class="w-full mb-4">
    {!! Form::label('last_name', 'Nom :', ['class' => 'block font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $user->last_name }}</p>
</div>

<!-- Role Field -->
<div class="w-full mb-4">
    {!! Form::label('role', 'Rôle :', ['class' => 'block font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $role }}</p>
</div>

<!-- Email Field -->
<div class="w-full mb-4">
    {!! Form::label('email', 'Email :', ['class' => 'block font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $user->email }}</p>
</div>

<!-- Phone Field -->
<div class="w-full mb-4">
    {!! Form::label('phone', 'Téléphone :', ['class' => 'block font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ ($user->phone) ?: "(xxx) xxx xx xx" }}</p>
</div>

<!-- Register At Field -->
<div class="w-full mb-4">
    {!! Form::label('register_at', 'Date d\'inscription :', ['class' => 'block font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $register_at }}</p>
</div>
