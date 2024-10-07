<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $abonnement->user_id }}</p>
</div>

<!-- Abonnement Id Field -->
<div class="col-sm-12">
    {!! Form::label('abonnement_id', 'Abonnement Id:') !!}
    <p>{{ $abonnement->abonnement_id }}</p>
</div>

<!-- End Date Field -->
<div class="col-sm-12">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $abonnement->end_date }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $abonnement->price }}</p>
</div>

