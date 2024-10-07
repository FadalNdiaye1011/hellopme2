<!-- Pays Id Field -->
<div class="col-sm-12">
    {!! Form::label('pays_id', 'Pays Id:') !!}
    <p>{{ $address->pays_id }}</p>
</div>

<!-- Ville Field -->
<div class="col-sm-12">
    {!! Form::label('ville', 'Ville:') !!}
    <p>{{ $address->ville }}</p>
</div>

<!-- Local Address Field -->
<div class="col-sm-12">
    {!! Form::label('local_address', 'Local Address:') !!}
    <p>{{ $address->local_address }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $address->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $address->updated_at }}</p>
</div>

