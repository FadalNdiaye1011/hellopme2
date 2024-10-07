<!-- First Name Field -->
<div class="mb-4 w-full sm:w-1/2">
    {!! Form::label('first_name', 'First Name:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('first_name', null, ['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Last Name Field -->
<div class="mb-4 w-full sm:w-1/2">
    {!! Form::label('last_name', 'Last Name:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('last_name', null, ['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="mb-4 w-full sm:w-1/2">
    {!! Form::label('email', 'Email:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::email('email', null, ['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Phone Field -->
<div class="mb-4 w-full sm:w-1/2">
    {!! Form::label('phone', 'Phone:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('phone', null, ['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm', 'maxlength' => 255]) !!}
</div>

<!-- Whatsapp Field -->
<div class="mb-4 w-full sm:w-1/2">
    {!! Form::label('whatsapp', 'Whatsapp:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('whatsapp', null, ['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm', 'maxlength' => 255]) !!}
</div>

<!-- Bio Field -->
<div class="mb-4 w-full">
    {!! Form::label('bio', 'Bio:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::textarea('bio', null, ['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm', 'maxlength' => 65535]) !!}
</div>

<!-- Twitter Field -->
<div class="mb-4 w-full sm:w-1/2">
    {!! Form::label('twitter', 'Twitter:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('twitter', null, ['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm', 'maxlength' => 255]) !!}
</div>
