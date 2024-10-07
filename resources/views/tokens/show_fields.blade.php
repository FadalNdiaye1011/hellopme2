<!-- Tokenable Type Field -->
<div class="col-sm-12">
    {!! Form::label('tokenable_type', 'Tokenable Type:') !!}
    <p>{{ $token->tokenable_type }}</p>
</div>

<!-- Token Field -->
<div class="col-sm-12">
    {!! Form::label('token', 'Token:') !!}
    <p>{{ $token->token }}</p>
</div>

<!-- Refresh Token Field -->
<div class="col-sm-12">
    {!! Form::label('refresh_token', 'Refresh Token:') !!}
    <p>{{ $token->refresh_token }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $token->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $token->updated_at }}</p>
</div>

