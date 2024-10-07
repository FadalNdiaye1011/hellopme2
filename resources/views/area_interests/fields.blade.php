<!-- Libelle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('libelle', 'Libelle:') !!}
    {!! Form::text('libelle', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Opportunity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opportunity_id', 'Opportunity Id:') !!}
    {!! Form::select('opportunity_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Pays Partner Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pays_partner_id', 'Pays Partner Id:') !!}
    {!! Form::select('pays_partner_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Secteur Activite Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('secteur_activite_id', 'Secteur Activite Id:') !!}
    {!! Form::select('secteur_activite_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Expertise Domain Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expertise_domain_id', 'Expertise Domain Id:') !!}
    {!! Form::select('expertise_domain_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control', 'required']) !!}
</div>