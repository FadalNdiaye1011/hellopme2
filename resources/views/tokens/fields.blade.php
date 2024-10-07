<!-- Tokenable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tokenable_type', 'Tokenable Type:') !!}
    {!! Form::text('tokenable_type', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('token', 'Token:') !!}
    {!! Form::text('token', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Refresh Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('refresh_token', 'Refresh Token:') !!}
    {!! Form::text('refresh_token', null, ['class' => 'form-control']) !!}
</div>