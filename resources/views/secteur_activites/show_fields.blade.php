<!-- Libelle Field -->
<div class="col-sm-12">
    {!! Form::label('libelle', 'Libelle:') !!}
    <p>{{ $secteurActivite->libelle }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $secteurActivite->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $secteurActivite->updated_at }}</p>
</div>

