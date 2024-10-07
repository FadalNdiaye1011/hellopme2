
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Titre Field -->
                <div>
                    {!! Form::label('titre', 'Titre ') !!}
                    {!! Form::text('titre', null, ['class' => 'border p-2 rounded w-full', 'placeholder' => 'Fill up the title !', 'required']) !!}
                </div>

                <!-- Source Field -->
                <div>
                    {!! Form::label('source', 'Source :') !!}
                    {!! Form::url('source', null, ['class' => 'border p-2 rounded w-full', 'placeholder' => 'Insert the source link !']) !!}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Type Opportunité -->
                <div>
                    {!! Form::label('type', 'Type Opportunité ') !!}
                    <small style="color: red">*</small>
                    {!! Form::select('type_opportunity_id', $typeOpportunities->pluck('libelle', 'id'), null, ['class' => 'border p-2 rounded w-full', 'id' => 'opportunity_id', 'required']) !!}
                </div>

                <!-- Sous-secteurs -->
                <div>
                    {!! Form::label('secteur', 'Sous-secteurs') !!}
                    <small style="color: red">*</small>
                    {!! Form::select('secteur_activite_children_id', $secteurActivitesChildren->pluck('libelle', 'id'), null, ['class' => 'border p-2 rounded w-full', 'placeholder' => 'Choisir un sous-secteur...', 'required']) !!}
                </div>
            </div>

            <div class="mb-4">
                <!-- Image principal -->
                {!! Form::label('image_url', 'Image principal ') !!}
                {!! Form::url('image_url', null, ['class' => 'border p-2 rounded w-full', 'placeholder' => 'Insert the main image link !']) !!}
            </div>

            <div class="mb-4">
                <!-- Description Field -->
                {!! Form::label('description', 'Description ') !!}
                <small style="color: red">*</small>
                {!! Form::textarea('description', null, ['class' => 'border p-2 rounded w-full h-[25vh]', 'placeholder' => 'Fill up the description of this opportunity with explicit content !', 'required']) !!}
            </div>

            <div class="mb-4">
                <!-- Critères -->
                  {!! Form::label('criteres', 'Critéres ') !!}
                {!! Form::textarea('criteres', null, ['class' => 'border p-2 rounded w-full h-[25vh]', 'placeholder' => 'Fill up the requirements for this opportunity !']) !!}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Prescripteur -->
                <div>
                    {!! Form::label('prescripteur_id', 'Prescripteur ') !!}
                    <small style="color: red">*</small>
                    {!! Form::select('prescripteur_id', $prescripteurs->pluck('libelle', 'id'), null, ['class' => 'border p-2 rounded w-full', 'id' => 'prescripteur_id', 'placeholder' => 'Choisir le prescripteur ', 'required']) !!}
                </div>

                <!-- Pays -->
                <div>
                    {!! Form::label('pays', 'Pays ') !!}
                    <small style="color: red">*</small>
                    {!! Form::select('pays_partner_id', $paysPartners->pluck('pays_name', 'pays_partner_id'), null, ['class' => 'border p-2 rounded w-full', 'placeholder' => 'Choisir le pays à l\'origine', 'required']) !!}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <!-- Nom Contact -->
                <div>
                    {!! Form::label('nom_contact', 'Contact | nom ') !!}
                    {!! Form::text('nom_contact', null, ['class' => 'border p-2 rounded w-full', 'placeholder' => 'Fill up the name contact!']) !!}
                </div>

                <!-- Email Contact -->
                <div>
                    {!! Form::label('email_contact', 'Contact | email ') !!}
                    {!! Form::text('email_contact', null, ['class' => 'border p-2 rounded w-full', 'placeholder' => 'Fill up the email contact!']) !!}
                </div>

                <!-- Role Contact -->
                <div>
                    {!! Form::label('role_contact', 'Contact | role ') !!}
                    {!! Form::text('role_contact', null, ['class' => 'border p-2 rounded w-full', 'placeholder' => 'Fill up the role contact!']) !!}
                </div>
            </div>

            <div class="mb-4">
                <!-- Budget Field -->
                {!! Form::label('budget', 'Budget ') !!}
                {!! Form::number('budget', null, ['class' => 'border p-2 rounded w-full', 'id' => 'budget', 'placeholder' => 'Fill up the budget!']) !!}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Date de début -->
                <div>
                    {!! Form::label('started_at', 'Date Debut :') !!}
                    <input type="datetime-local" class="border p-2 rounded w-full" id="started_at" name="started_at" value="{{ !isset($databanks->started_at) ? '' : $databanks->started_at }}">
                </div>

                <!-- Deadline -->
                <div>
                    {!! Form::label('deadline', 'Deadline :') !!}
                    <input type="datetime-local" class="border p-2 rounded w-full" id="deadline" name="deadline" value="{{ !isset($databanks->deadline) ? '' : $databanks->deadline }}">
                </div>
            </div>

            <div class="mb-4">
                <!-- Deadline Question -->
                {!! Form::label('deadline_question', 'Deadline question :') !!}
                <input type="datetime-local" class="border p-2 rounded w-full" id="deadline_question" name="deadline_question" value="{{ !isset($databanks->deadline_question) ? '' : $databanks->deadline_question }}">
            </div>

            <div class="mb-4">
                <!-- Attachments -->
                {!! Form::label('attachments', 'Attachments') !!}
                {!! Form::url('attachments[]', null, ['class' => 'border p-2 rounded w-full mt-2', 'placeholder' => 'Insert the attachment link !']) !!}<br>
                {!! Form::url('attachments[]', null, ['class' => 'border p-2 rounded w-full mt-2', 'placeholder' => 'Insert the attachment link !']) !!}<br>
                {!! Form::url('attachments[]', null, ['class' => 'border p-2 rounded w-full mt-2', 'placeholder' => 'Insert the attachment link !']) !!}
            </div>


            @push('page_scripts')
                <script type="text/javascript">
                    $('#started_at').datepicker()
                </script>
            @endpush


            @push('page_scripts')
                <script type="text/javascript">
                    $('#deadline').datepicker()
                </script>
            @endpush
