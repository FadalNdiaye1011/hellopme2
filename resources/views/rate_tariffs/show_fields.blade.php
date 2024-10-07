@php
$prescripteur = App\Models\Prescripteur::where('finance_id', $rateTariff->finance_id)->first();
@endphp

<!-- Libelle Field -->
<div class="mb-4 col-sm-12">
    {!! Form::label('libelle', 'Libelle:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-900">{{ $rateTariff->libelle }}</p>
</div>

<!-- Value Field -->
<div class="mb-4 col-sm-12">
    {!! Form::label('value', 'Valeur:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-900">{{ $rateTariff->value }}</p>
</div>

<!-- Finance Id Field -->
<div class="mb-4 col-sm-12">
    {!! Form::label('finance_id', 'Finance:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-900">{{ $prescripteur->libelle }}</p>
</div>

<!-- Created At Field -->
<div class="mb-4 col-sm-12">
    {!! Form::label('created_at', 'Created At:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-900">{{ $rateTariff->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="mb-4 col-sm-12">
    {!! Form::label('updated_at', 'Updated At:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-900">{{ $rateTariff->updated_at }}</p>
</div>
