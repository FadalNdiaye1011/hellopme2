<!-- Pays Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pays_id', 'Pays Id:') !!}
    {!! Form::select('pays_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Ville Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ville', 'Ville:') !!}
    {!! Form::text('ville', null, ['class' => 'form-control']) !!}
</div>

<!-- Local Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('local_address', 'Local Address:') !!}
    {!! Form::text('local_address', null, ['class' => 'form-control']) !!}
</div>
