
<form class="form-recherche-rapide w-100" method="get" action="{{ route('opportunities.search') }}">
    <div class="row g-3">
        <div class="col-md-6 col-lg-3 form-group">
            <label for="type_opportunity_id"><b>Type d'opportunités</b></label>
                {!! Form::select('type_opportunity_id', $typeOpportunities->pluck('libelle', 'id'), null, ['class' => 'form-control custom-select', 'id' => 'type_opportunity_id', 'placeholder' => 'Selectionner un type', 'disabled']) !!}
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Récupérer l'URL actuelle
                    const currentUrl = window.location.href;
                    // Récupérer le champ 'select' des types d'opportunité
                    const typeSelect = document.getElementById('type_opportunity_id');

                    // Vérifier l'URL et sélectionner le bon type d'opportunité
                    if (currentUrl.includes('/financements')) {
                        // Sélectionner l'option correspondant à 'Financement' (supposons que l'ID est 1)
                        typeSelect.value = '2'; // Remplace '1' par l'ID réel de 'Financement'

                    } else if (currentUrl.includes('/evenements')) {
                        // Sélectionner l'option correspondant à 'Événements' (supposons que l'ID est 2)
                        typeSelect.value = '3'; // Remplace '2' par l'ID réel de 'Événements'
                    }
                    else if (currentUrl.includes('')) {
                        // Sélectionner l'option correspondant à 'Événements' (supposons que l'ID est 2)
                        typeSelect.value = '1'; // Remplace '2' par l'ID réel de 'Événements'
                    }
                    // Tu peux ajouter d'autres vérifications selon tes types d'opportunité et leurs URLs
                });
    </script>

        </div>
        <div class="col-md-6 col-lg-3 form-group">
            <label for="pays_partner_id"><b>Pays</b></label>
            {!! Form::select('pays_partner_id', $paysPartners->pluck('pays_name', 'pays_partner_id'), null, ['class' => 'form-control custom-select', 'id' => 'pays_partner_id', 'placeholder' => 'Selectionner un pays']) !!}
        </div>
        <div class="col-md-6 col-lg-3 form-group">
            <label for="secteur_activite_id"><b>Secteur d'activités</b></label>
            {!! Form::select('secteur_activite_id', $secteur_activites->pluck('libelle', 'id'), null, ['class' => 'form-control custom-select', 'id' => 'secteur_activite_id', 'placeholder' => 'Choisir un secteur']) !!}
        </div>
        <div class="col-md-6 col-lg-3 form-group">
            <button type="submit" class="btn btn-recherche w-100 d-flex justify-content-center gap-6" data-toggle="tooltip" data-placement="top" title="Functionality will be available soon!">
                <!-- <img src="{{asset('img/search-normal.svg')}}" alt=""> Trouver -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 1.5rem;"><path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z"></path></svg>
                Trouver
            </button>
        </div>
    </div>
</form>
