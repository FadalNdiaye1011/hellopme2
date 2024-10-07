@php
$prescripteur = App\Models\Prescripteur::where('finance_id', $service->finance_id)->first();
@endphp

<!-- Libelle Field -->
<div class="col-span-12 mb-4">
    {!! Form::label('libelle', 'Libelle:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-900">{{ $service->libelle }}</p>
</div>

<!-- Finance Id Field -->
<div class="col-span-12 mb-4">
    {!! Form::label('finance_id', 'Finance:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-900">{{ $prescripteur->libelle }}</p>
</div>

<!-- Created At Field -->
<div class="col-span-12 mb-4">
    {!! Form::label('created_at', 'Created At:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-900">{{ $service->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-span-12 mb-4">
    {!! Form::label('updated_at', 'Updated At:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-900">{{ $service->updated_at }}</p>
</div>
