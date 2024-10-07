<!-- Libelle Field -->
<div class="col-span-12 mb-4">
    {!! Form::label('libelle', 'Libelle:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('libelle', null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500', 'required']) !!}
</div>
{!! Form::hidden('finance_id', $finance->id) !!}
