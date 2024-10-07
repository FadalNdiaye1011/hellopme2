@php
$prescripteur = App\Models\Prescripteur::where('finance_id', $finance->id)->first();
if(empty($prescripteur))
    return 0;

$url = asset('img/logo-shredded.png');
$prescripteur->logo = ($prescripteur->logo) ? Storage::disk('s3')->url('prescripteurs/logos/'. $prescripteur->logo) : $url;
$prescripteur->pays = ($prescripteur->pays_id) ? App\Models\Pays::find($prescripteur->pays_id) : 'Aucun pays !';
@endphp

<!-- Finance Section -->
<div class="w-full mb-6">
    <img src="{{ $prescripteur->logo }}" width="60" alt="Logo" class="mb-4">
    <p class="font-bold text-lg">{{ $prescripteur->libelle }}</p>
</div>

<div class="w-full md:w-1/2 mb-4">
    {!! Form::label('town', 'Ville', ['class' => 'font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $prescripteur->town }}</p>
</div>

<div class="w-full md:w-1/2 mb-4">
    {!! Form::label('pays', 'Pays', ['class' => 'font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $prescripteur->pays->fr }}</p>
</div>

<div class="w-full mb-4">
    {!! Form::label('website', 'Site web', ['class' => 'font-semibold text-gray-700']) !!}
    <p class="text-blue-600">{{ $prescripteur->website }}</p>
</div>

<!-- Titre Responsable Field -->
<div class="w-full md:w-1/3 mb-4">
    {!! Form::label('titre_responsable', 'Titre Responsable', ['class' => 'font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $prescripteur->titre_responsable }}</p>
</div>

<!-- Nom Responsable Field -->
<div class="w-full md:w-1/3 mb-4">
    {!! Form::label('nom_responsable', 'Nom Responsable', ['class' => 'font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $prescripteur->nom_responsable }}</p>
</div>

<!-- Phone Responsable Field -->
<div class="w-full md:w-1/3 mb-4">
    {!! Form::label('phone_responsable', 'Phone Responsable:', ['class' => 'font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $prescripteur->phone_responsable }}</p>
</div>

<!-- Type Finance Field -->
<div class="w-full mb-4">
    {!! Form::label('type_finance', 'Type Finance', ['class' => 'font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $finance->type_finance }}</p>
</div>

<!-- Declaration Field -->
<div class="w-full mb-4">
    {!! Form::label('declaration', 'Declaration', ['class' => 'font-semibold text-gray-700']) !!}
    <p class="text-gray-900">{{ $finance->declaration }}</p>
</div>
