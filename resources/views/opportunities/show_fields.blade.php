@php
setlocale(LC_TIME, 'fr_FR');
$none_entity = "None";
$type = ($opportunity->type_opportunity_id) ? \App\Models\TypeOpportunity::find($opportunity->type_opportunity_id) : null;
$prescripteur = ($opportunity->prescripteur_id) ? \App\Models\Prescripteur::find($opportunity->prescripteur_id) : null;
$pays_partner = DB::table('pays_partners')
->select('pays.fr as libelle')
->join('pays', 'pays.id', 'pays_partners.pays_id')
->where('pays_partners.id', $opportunity->pays_partner_id)
->first();
$started_at = ($opportunity->started_at) ?: $none_entity;
$deadline = ($opportunity->deadline) ?: $none_entity;
$image_url = ($opportunity->image_url) ?: asset('images/a-la-une-default.png');
$source = ($opportunity->source) ?: null;

$attachments = \App\Models\Attachment::where('databank_id', $opportunity->id)->get();

@endphp

<!-- Titre Field -->
<div class="col-sm-12">
    {!! Form::label('titre', 'Titre :') !!}
    <p>{{ $opportunity->titre }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description :') !!}
    <p>{{ $opportunity->description }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('criteres', 'Criteres :') !!}
    <p>{!! ($opportunity->criteres) ?: '<small style="color:red">Aucun critere signale !</small>' !!}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('image', 'Image principale :') !!}
    <p><a href="{{$image_url}}" target="_blank">Cliquer pour voir l'image de l'opportunite ! </a></p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type :') !!}
    <p>{{ (!empty($type)) ? $type->libelle : 'None' }}</p>
</div>

<!-- Nom Client Field -->
<div class="col-sm-12">
    {!! Form::label('prescripteur', 'Prescripteur :') !!}
    <p>{{ (!empty($prescripteur)) ? $prescripteur->libelle : 'None' }}</p>
</div>


<div class="col-sm-12">
    {!! Form::label('pays', 'Pays :') !!}
    <p>{{ (!empty($pays_partner)) ? $pays_partner->libelle : 'None' }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('source', 'Source :') !!}
    <p>@if($source) <a href="{{$source}}" target="_blank">Cliquer pour voir la source de cette opportunite ! </a> @else  <small style="color:red">Aucune source renseigne !</small> @endif </p>
</div>

@if(!empty($attachments))
<div class="col-sm-12">
    {!! Form::label('attachment', 'Pieces jointes :') !!}
    <p>

        @php
        foreach ( $attachments as $attachment ):
            if(!$attachment->url)
                continue;

            echo '<a href="'.$attachment->url.'" target="_blank"> Voir piece jointe !</a>  |';
        endforeach
        @endphp
    </p>
</div>
@endif
<!-- Started At Field -->
<div class="col-sm-12">
    {!! Form::label('started_at', 'Debut :') !!}
    <p>{{ $started_at }}</p>
</div>

<!-- Deadline Field -->
<div class="col-sm-12">
    {!! Form::label('deadline', 'Deadline :') !!}
    <p>{{ $deadline }}</p>
</div>


