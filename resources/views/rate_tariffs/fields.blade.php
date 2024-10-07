<!-- Libelle Field -->
<div class="mb-4 col-sm-6">
    {!! Form::label('libelle', 'Libelle:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('libelle', null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500', 'required']) !!}
</div>

<!-- Value Field -->
<div class="mb-4 col-sm-6">
    {!! Form::label('value', 'Value:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('value', null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500', 'required']) !!}
</div>

{!! Form::hidden('finance_id', $finance->id) !!}
