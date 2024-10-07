<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::text('id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Source Field -->
<div class="form-group col-sm-6">
    {!! Form::label('source', 'Source:') !!}
    {!! Form::text('source', null, ['class' => 'form-control']) !!}
</div>