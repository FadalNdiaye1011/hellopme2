<!-- Libelle Field -->
<div class="col-sm-12">
    {!! Form::label('libelle', 'Libelle:') !!}
    <p>{{ $attachment->libelle }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $attachment->type }}</p>
</div>

<!-- Source Field -->
<div class="col-sm-12">
    {!! Form::label('source', 'Source:') !!}
    <p>{{ $attachment->source }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $attachment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $attachment->updated_at }}</p>
</div>

