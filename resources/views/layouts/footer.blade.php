<!-- Option 1: Bootstrap Bundle with Popper -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-element col-lg-5 col-md-4">
                <img class="img-footer" src="{{asset('img/logo.svg')}}" alt="">
                <p class="description">HelloPME facilite l'accès et le suivi des opportunités d'affaires, de financement,
                    d'accompagnement et de réseautage des PME en Afrique.</p>
                <div class="d-flex align-items-center element-infos">
                    <img src="{{asset('img/map.svg')}}" alt="">
                    <p class="mb-0">47, Bd de la République - Immeuble SORANO</p>
                </div>
                <div class="d-flex align-items-center element-infos">
                    <img src="{{asset('img/mail.svg')}}" alt="">
                    <p class="mb-0">info@hellopme.com</p>
                </div>
                <div class="d-flex align-items-center element-infos">
                    <img src="{{asset('img/phone.svg')}}" alt="">
                    <p class="mb-0">+221 33 827 99 91</p>
                </div>
                <div class="d-flex align-items-center element-infos">
                    <img src="{{asset('img/fax.svg')}}" alt="">
                    <p class="mb-0">+221 77 416 69 69</p>
                </div>
            </div>
            <div class="col-element col-lg-3 col-md-4">
                <p class="title-footer">Hello PME</p>
                <ul class="liste-element-pme">
                    <li>
                        <a href="">Appels d'Offres</a>
                    </li>
                    <li>
                        <a href="">Financement</a>
                    </li>
                    <li>
                        <a href="">Appels d'Offres</a>
                    </li>
                    <li>
                        <a href="">Evénements</a>
                    </li>
                    <li>
                        <a href="">Experts</a>
                    </li>
                    <li>
                        <a href="">Partenaires</a>
                    </li>
                    <li>
                        <a href="">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <p class="title-footer">Hello PME</p>
                <p>Inscrivez-vous à notre newsletter pour bénéficier des informations sur l'audit & conseils à tout moment !</p>
                <button class="btn btn-abonement">Je m'abonne</button>
            </div>
        </div>
        <div class="sub-footer d-flex justify-content-between">
            <p class="text-subFooter">©2023 - Hello PME</p>
            <div class="d-flex otherPage">
                <p class="text-subFooter">Mentions légales</p> 
                <p class="text-subFooter">FAQ</p>
                <p class="text-subFooter">Contact</p>
            </div>
            <div class="d-flex">
                <a href="" class="resaux">
                    <img src="{{asset('img/linkedin.svg')}}" alt="">
                </a>
                <a href="" class="resaux">
                    <img src="{{asset('img/Facebook.svg')}}" alt="">
                </a>
                <a href="" class="resaux">
                    <img src="{{asset('img/Twitter.svg')}}" alt="">
                </a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/popper.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<script src="{{ asset('/js/bootstrap.js') }}"></script>
<script src="{{ asset('/js/style.js') }}"></script>
{{--<script src="{{ mix('js/app.js') }}"></script>--}}
<script>
    $(function(){
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    $(document).ready(function() {
        // Initialisation du carrousel
        $('#recipeCarousel').carousel({
            interval: 10000
        });

        function adjustCarousel() {
            var windowWidth = $(window).width();
            var minPerSlide = 6; // Nombre d'éléments à afficher sur les grands écrans

            if (windowWidth < 764) {
                minPerSlide = 3; // Réduisez le nombre d'éléments à 3 pour les appareils mobiles
            }

            $('.carousel .carousel-item-modife').each(function() {
                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                for (var i = 0; i < minPerSlide; i++) {
                    next.children(':first-child').clone().appendTo($(this));
                    next = next.next();
                    if (!next.length) {
                        next = $(this).siblings(':first');
                    }
                }
            });
        }

        // Appelez la fonction d'ajustement lors du chargement initial et du redimensionnement de la fenêtre
        adjustCarousel();

        $(window).on('resize', function() {
            adjustCarousel();
        });
    });


</script>
</body>
</html>
