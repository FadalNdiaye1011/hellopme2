<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="form-group">
        {!! Form::label('url', 'Site Url:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
        {!! Form::text('url', null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('content_wrapper', 'Selecteur | Article', ['class' => 'block text-sm font-medium text-gray-700']) !!}
        {!! Form::text('content_wrapper', null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('title_selector', 'Selecteur | Titre:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
        {!! Form::text('title_selector', null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('detail_page_content_selector', 'Selecteur | Contenu Detail page', ['class' => 'block text-sm font-medium text-gray-700']) !!}
        {!! Form::text('detail_page_content_selector', null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('image_url', 'Selecteur | Image', ['class' => 'block text-sm font-medium text-gray-700']) !!}
        {!! Form::text('image_url', null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('type_opportunity_id', 'Type Opportunité:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
        {!! Form::select('type_opportunity_id', $typeOpportunities->pluck('libelle', 'id'), null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4', 'placeholder' => 'Choisir le type d\'opportunite', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('pays', 'Pays:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
        {!! Form::select('pays_partner_id', $paysPartners->pluck('pays_name', 'pays_partner_id'), null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4', 'placeholder' => 'Choisir le pays à l\'origine', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('prescripteur_id', 'Prescripteur:', ['class' => 'block text-sm font-medium text-gray-700']) !!}
        {!! Form::select('prescripteur_id', $prescripteurs->pluck('libelle', 'id'), null, ['class' => 'mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 p-4', 'placeholder' => 'Choisir le prescripteur', 'required']) !!}
    </div>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#started_at').datepicker()
        $('#deadline').datepicker()
    </script>
@endpush
