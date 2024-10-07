@include('layouts.header')

@section('content')
    <body>
    <div class="content-head-detail">
        <div class="container">
            <div class="d-flex">
                <a href="" class="element-nav">Accueil /</a>
                <a href="" class="element-nav">Appels d'offres /</a>
                <a href="" class="element-nav">Fourniture, le montage et l'installation de fauteuil</a>
            </div>
        </div>
    </div>
    <section class="content-body-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <p class="title-detail-offre">
                        Fourniture, le montage et l'installation de fauteuils de réunion et de fauteuils
                        pour le personnel de tri au profit de l'Agence Principale de la BCEAO à Abidjan (Côte d'Ivoire)
                    </p>
                    <p class="description-detail-offre">I'm baby kombucha same scenester pinterest pug twee. +1 trust fund crucifix,
                        meggings sartorial food truck bitters kombucha activated charcoal tote bag. YOLO bespoke solarpunk cold-pressed,
                        four dollar toast lo-fi squid. Mukbang listicle wayfarers praxis fam chillwave, meh live-edge.
                        Fingerstache tonx cupping, put a bird on it pug sus gochujang banjo sriracha copper mug yes plz.</p>
                    <a href="" class="btn btn-voir-tout">Connectez-vous pour voir les détails</a>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card-detail-activite">
                        <div class="sub-block">
                            <p class="title">Pays</p>
                            <p class="sub-title">Côte d'Ivoire</p>
                        </div>
                        <div class="sub-block">
                            <p class="title">Deadline</p>
                            <p class="sub-title">20 Septembre 2023</p>
                        </div>
                        <div class="sub-block">
                            <p class="title">Secteur d’activité</p>
                            <p class="sub-title">Digital</p>
                        </div>
                        <div class="sub-block">
                            <p class="title">Type</p>
                            <p class="sub-title">Appel d’offre</p>
                        </div>
                        <div class="piece-jointe-block">
                            <p class="title">pièces jointes</p>
                            <div class="element-doc d-flex">
                                <img src="{{asset('img/pdf.png')}}" alt="">
                                <div>
                                    <p class="name">Etiam adipiscing diam sapien aliquam pellentesque ut dictum</p>
                                    <p class="number-mb">1.6 Mb</p>
                                </div>
                            </div>
                            <div class="element-doc d-flex">
                                <img src="{{asset('img/pdf.png')}}" alt="">
                                <div>
                                    <p class="name">Etiam adipiscing diam sapien aliquam pellentesque ut dictum</p>
                                    <p class="number-mb">1.6 Mb</p>
                                </div>
                            </div>
                            <div class="element-doc d-flex">
                                <img src="{{asset('img/pdf.png')}}" alt="">
                                <div>
                                    <p class="name">Etiam adipiscing diam sapien aliquam pellentesque ut dictum</p>
                                    <p class="number-mb">1.6 Mb</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-partage d-flex justify-content-between align-items-center">
                        <p>Partager</p>
                        <div class="d-flex">
                            <a href="">
                                <img src="{{asset('img/twitter-white.svg')}}" alt="">
                            </a>
                            <a href="">
                                <img src="{{asset('img/facebook-white.svg')}}" alt="">
                            </a>
                            <a href="">
                                <img src="{{asset('img/linkedin-whiite.svg')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="block-img-marketing">
                        <img src="{{asset('img/marketing.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="content-appels-offres">
                <p class="sub-title">Ces autres appels d’offres pourraient vous intérésser ...</p>
                <div class="group-card-appel-offre d-flex flex-wrap">
                    <div class="card-appel-offres">
                        <div class="pays d-flex">
                            <img src="{{asset('img/CI-flag.png')}}" alt="">
                            <p class="name-pays">cote d’ivoire</p>
                        </div>
                        <p class="title-card-appel-offres">Fourniture, le montage et l'installation de fauteuils de réunion et de fauteuils pour ...</p>
                        <div class="footer-card-offre d-flex flex-wrap">
                            <div class="element-detail-financement">
                                <p class="secteur-title">Secteur d'activités</p>
                                <p class="sub-categorie">Transport</p>
                            </div>
                            <div class="element-detail-financement">
                                <p class="secteur-title">Type d’opportunités</p>
                                <p class="sub-categorie">Appel d’offres</p>
                            </div>
                            <div class="element-detail-financement">
                                <p class="secteur-title">Date de publication</p>
                                <p class="sub-categorie">10 Janvier 2023</p>
                            </div>
                            <div class="element-detail-financement">
                                <p class="secteur-title">Deadline</p>
                                <p class="sub-categorie">11 Avril 2023</p>
                            </div>
                            <div class="d-flex w-100">
                                <button class="btn mr-2">
                                    <img src="{{asset('img/save.png')}}" alt="">
                                    Sauvegarder
                                </button>
                                <a href="" class="btn">
                                    <img src="{{asset('img/details.png')}}" alt="">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-appel-offres">
                        <div class="pays d-flex">
                            <img src="{{asset('img/CI-flag.png')}}" alt="">
                            <p class="name-pays">cote d’ivoire</p>
                        </div>
                        <p class="title-card-appel-offres">Fourniture, le montage et l'installation de fauteuils de réunion et de fauteuils pour ...</p>
                        <div class="footer-card-offre d-flex flex-wrap">
                            <div class="element-detail-financement">
                                <p class="secteur-title">Secteur d'activités</p>
                                <p class="sub-categorie">Transport</p>
                            </div>
                            <div class="element-detail-financement">
                                <p class="secteur-title">Type d’opportunités</p>
                                <p class="sub-categorie">Appel d’offres</p>
                            </div>
                            <div class="element-detail-financement">
                                <p class="secteur-title">Date de publication</p>
                                <p class="sub-categorie">10 Janvier 2023</p>
                            </div>
                            <div class="element-detail-financement">
                                <p class="secteur-title">Deadline</p>
                                <p class="sub-categorie">11 Avril 2023</p>
                            </div>
                            <div class="d-flex w-100">
                                <button class="btn mr-2">
                                    <img src="{{asset('img/save.png')}}" alt="">
                                    Sauvegarder
                                </button>
                                <a href="" class="btn">
                                    <img src="{{asset('img/details.png')}}" alt="">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-appel-offres">
                        <div class="pays d-flex">
                            <img src="{{asset('img/CI-flag.png')}}" alt="">
                            <p class="name-pays">cote d’ivoire</p>
                        </div>
                        <p class="title-card-appel-offres">Fourniture, le montage et l'installation de fauteuils de réunion et de fauteuils pour ...</p>
                        <div class="footer-card-offre d-flex flex-wrap">
                            <div class="element-detail-financement">
                                <p class="secteur-title">Secteur d'activités</p>
                                <p class="sub-categorie">Transport</p>
                            </div>
                            <div class="element-detail-financement">
                                <p class="secteur-title">Type d’opportunités</p>
                                <p class="sub-categorie">Appel d’offres</p>
                            </div>
                            <div class="element-detail-financement">
                                <p class="secteur-title">Date de publication</p>
                                <p class="sub-categorie">10 Janvier 2023</p>
                            </div>
                            <div class="element-detail-financement">
                                <p class="secteur-title">Deadline</p>
                                <p class="sub-categorie">11 Avril 2023</p>
                            </div>
                            <div class="d-flex w-100">
                                <button class="btn mr-2">
                                    <img src="{{asset('img/save.png')}}" alt="">
                                    Sauvegarder
                                </button>
                                <a href="" class="btn">
                                    <img src="{{asset('img/details.png')}}" alt="">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="btn btn-voir-tout">Voir toutes les appels d’offres</a>
            </div>
        </div>
    </section>
    @extends('layouts.footer')
    </body>
    </html>
