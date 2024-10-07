<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userAbonnement->user_id }}</p>
</div>

<!-- Abonnement Id Field -->
<div class="col-sm-12">
    {!! Form::label('abonnement_id', 'Abonnement Id:') !!}
    <p>{{ $userAbonnement->abonnement_id }}</p>
</div>

<!-- End Date Field -->
<div class="col-sm-12">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $userAbonnement->end_date }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $userAbonnement->price }}</p>
</div>

