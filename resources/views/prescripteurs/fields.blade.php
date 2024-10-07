<!-- Libelle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('libelle', 'Libelle:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('libelle', null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 py-4 px-3', 'required']) !!}
</div>

<!-- Logo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('logo', 'Logo:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    <div class="mt-1">
        {!! Form::file('logo', ['class' => 'block w-full text-sm text-gray-500 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 py-4 px-3']) !!}
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('town', 'Ville :', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('town', null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 py-4 px-3']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('pays', 'Pays :', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::select('pays_id', $pays->pluck('fr', 'id'), null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 py-4 px-3', 'placeholder' => 'Choisir le pays', 'required']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('website', 'Site web :', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::url('website', null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 py-4 px-3', 'placeholder' => 'Site web ...']) !!}
</div>

<!-- Titre Responsable Field -->
<div class="form-group col-sm-4">
    {!! Form::label('titre_responsable', 'Titre Responsable:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('titre_responsable', null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 py-4 px-3']) !!}
</div>

<!-- Nom Responsable Field -->
<div class="form-group col-sm-4">
    {!! Form::label('nom_responsable', 'Nom Responsable:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('nom_responsable', null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 py-4 px-3', 'required']) !!}
</div>

<!-- Phone Responsable Field -->
<div class="form-group col-sm-4">
    {!! Form::label('phone_responsable', 'Phone Responsable:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
    {!! Form::text('phone_responsable', null, ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 py-4 px-3', 'required']) !!}
</div>

<div class="clearfix"></div>
