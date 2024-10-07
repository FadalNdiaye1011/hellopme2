@include('layouts.header')

@section('content')
<body>
    <section class="content-body-home bg-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <p class="sub-title">Experts de la semaine</p>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('img/bg2.png')}}" alt="">
                                <div class="carousel-caption d-md-block">
                                    <div class="bottom-align">
                                        <h2>Cabinet XYZ</h2>
                                        <p>Intelligence financière - Leadership</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('img/bg2.png')}}" alt="">
                                <div class="carousel-caption d-md-block">
                                    <div class="bottom-align">
                                        <h2>Cabinet XYZ</h2>
                                        <p>Intelligence financière - Leadership</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('img/bg2.png')}}" alt="">
                                <div class="carousel-caption d-md-block">
                                    <div class="bottom-align">
                                        <h2>Cabinet XYZ</h2>
                                        <p>Intelligence financière - Leadership</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <p class="sub-title">Structures d’accompagnement des PME</p>
                    <div>
                        <div class="card-element-accompagnement-pme">
                            <div class="block-img">
                                <img src="{{asset('img/ftp.png')}}" alt="">
                            </div>
                            <p class="name-structure">3FPT</p>
                        </div>
                        <div class="card-element-accompagnement-pme">
                            <div class="block-img">
                                <img src="{{asset('img/der.png')}}" alt="">
                            </div>
                            <p class="name-structure">DER</p>
                        </div>
                        <div class="card-element-accompagnement-pme">
                            <div class="block-img">
                                <img src="{{asset('img/fdfp.png')}}" alt="">
                            </div>
                            <p class="name-structure">FDFP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-body-home">
        <div class="container">
            <div class="block-consultant">
                <p class="sub-title">Consultants accrédités</p>
                <div class="content-card-consultant d-flex flex-wrap">
                    <div class="card-element-accompagnement-pme">
                        <div class="block-img">
                            <img src="{{asset('img/cabinet.png')}}" alt="">
                        </div>
                        <div>
                            <p class="name-structure">Cabinet XYZ</p>
                            <p class="categori">Intelligence financière - Leadership</p>
                        </div>
                    </div>
                    <div class="card-element-accompagnement-pme">
                        <div class="block-img">
                            <img src="{{asset('img/cabinet.png')}}" alt="">
                        </div>
                        <div>
                            <p class="name-structure">Cabinet XYZ</p>
                            <p class="categori">Intelligence financière - Leadership</p>
                        </div>
                    </div>
                    <div class="card-element-accompagnement-pme">
                        <div class="block-img">
                            <img src="{{asset('img/cabinet.png')}}" alt="">
                        </div>
                        <div>
                            <p class="name-structure">Cabinet XYZ</p>
                            <p class="categori">Intelligence financière - Leadership</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-cabinet">
                <p class="sub-title">Cabinets de formation accrédités</p>
                <div class="content-card-consultant d-flex flex-wrap">
                    <div class="card-element-accompagnement-pme">
                        <div class="block-img">
                            <img src="{{asset('img/cabinet.png')}}" alt="">
                        </div>
                        <div>
                            <p class="name-structure">Cabinet XYZ</p>
                            <p class="categori">Intelligence financière - Leadership</p>
                        </div>
                    </div>
                    <div class="card-element-accompagnement-pme">
                        <div class="block-img">
                            <img src="{{asset('img/cabinet.png')}}" alt="">
                        </div>
                        <div>
                            <p class="name-structure">Cabinet XYZ</p>
                            <p class="categori">Intelligence financière - Leadership</p>
                        </div>
                    </div>
                    <div class="card-element-accompagnement-pme">
                        <div class="block-img">
                            <img src="{{asset('img/cabinet.png')}}" alt="">
                        </div>
                        <div>
                            <p class="name-structure">Cabinet XYZ</p>
                            <p class="categori">Intelligence financière - Leadership</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-partenaires-financement">
        <div class="container">
            <p class="sub-title">Partenaires de financement des PME</p>
            <div class="container mt-5 text-center my-3">
                <div class="row mx-auto my-auto">
                    <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            <div class="carousel-item carousel-item-modife active">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p1.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p2.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p3.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p4.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p2.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p1.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p3.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p4.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p1.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p2.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-modife">
                                <div class="col-md-2 col-sm-4">
                                    <div class="card-partenaire-de-financement">
                                        <img src="{{asset('img/p3.png')}}" alt="">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                            <img src="{{asset('img/arrow-left.png')}}" alt="">
                        </a>
                        <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                            <img src="{{asset('img/arrow-right.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@extends('layouts.footer')
</body>
</html>
