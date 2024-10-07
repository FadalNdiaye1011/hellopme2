<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::number('type', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('durations', 'Durée (en mois)') !!}
    {!! Form::number('durations', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('price', 'Prix:') !!}
    {!! Form::text('price', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('price', 'Prix:') !!}
    {!! Form::text('price', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('statut', 'Statut:') !!}
    {!! Form::select('statut', [], null, ['class' => 'form-control custom-select']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#end_date').datepicker()
    </script>
@endpush

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control', 'required']) !!}
</div>
