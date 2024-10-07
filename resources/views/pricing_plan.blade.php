@include('layouts.header')

@section('content')
<style>
    body {
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }

    .pricing-content {}

    .single-pricing {
        background: #fff;
        padding: 40px 20px;
        border-radius: 5px;
        position: relative;
        z-index: 2;
        border: 1px solid #eee;
        box-shadow: 0 10px 40px -10px rgba(0, 64, 128, .09);
        transition: 0.3s;
    }

    @media only screen and (max-width:480px) {
        .single-pricing {
            margin-bottom: 30px;
        }
    }

    .single-pricing:hover {
        box-shadow: 0px 60px 60px rgba(0, 0, 0, 0.1);
        z-index: 100;
        transform: translate(0, -10px);
    }

    .price-label {
        color: #fff;
        background: #677B44;
        font-size: 16px;
        width: 100px;
        margin-bottom: 15px;
        display: block;
        clip-path: polygon(100% 0%, 90% 50%, 100% 100%, 0% 100%, 0 50%, 0% 0%);
        margin-left: -20px;
        position: absolute;
    }

    .price-head h2 {
        font-weight: 600;
        margin-bottom: 0px;
        text-transform: capitalize;
        font-size: 26px;
    }

    .price-head span {
        display: inline-block;
        background: #677B44;
        width: 6px;
        height: 6px;
        border-radius: 30px;
        margin-bottom: 20px;
        margin-top: 15px;
    }

    .price {
        font-weight: 500;
        font-size: 50px;
        margin-bottom: 0px;
    }

    .single-pricing h5 {
        font-size: 14px;
        margin-bottom: 0px;
        text-transform: uppercase;
    }

    .single-pricing ul {
        list-style: none;
        margin-bottom: 20px;
        margin-top: 30px;
    }

    .single-pricing ul li {
        line-height: 35px;
    }

    .single-pricing a, .single-pricing button {
        background: none;
        border: 2px solid #677B44;
        border-radius: 5000px;
        color: #677B44;
        display: inline-block;
        font-size: 16px;
        overflow: hidden;
        padding: 10px 45px;
        text-transform: capitalize;
        transition: all 0.3s ease 0s;
    }

    .single-pricing a:hover,
    .single-pricing a:focus,
    .single-pricing button:hover {
        background: #677B44;
        color: #fff;
    }

    .single-pricing-white {
        background: #232434;
    }

    .single-pricing-white ul li,
    .single-pricing-white h2,
    .single-pricing-white h1,
    .single-pricing-white h5 {
        color: #fff;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        animation: fadeIn 0.4s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    /* Form Styles in Modal */
    .modal-content h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .modal-content form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .modal-content label {
        margin: 10px 0;
        font-size: 16px;
        cursor: pointer;
    }

    .modal-content button {
        background: #677B44;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .modal-content button:hover {
        background: #5a6e38;
    }
</style>

<body>
    <section id="pricing" class="pricing-content section-padding">
        <div class="container">
            <div class="section-title text-center p-4">
                <h1>Pricing Plan</h1>
            </div>
            <div class="row text-center p-5">
                <!-- Free Plan -->
                <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="single-pricing">
                        <div class="price-head">
                            <h2>Gratuit</h2>
                        </div>
                        <h1 class="price">0 fcfa</h1>
                        <h5>15 jours</h5>
                        <ul>
                            <!-- Add features here -->
                        </ul>
                        <a href="#">Je choisis la formule gratuit</a>
                    </div>
                </div>
                <!-- Starter Plan -->
                <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="single-pricing">
                        <div class="price-head">
                            <h2>Hello Starter</h2>
                        </div>
                        <h1 class="price">10 000 fcfa</h1>
                        <h5>mois</h5>
                        <ul>
                            <li>Appels d’offres : 1 pays, 1 secteur</li>
                            <li>Opportunités de financement</li>
                            <li>Evènements et réseautage</li>
                            <li>1 utilisateur</li>
                        </ul>
                        <button onclick="openModal('Abonnement Basique', 10000)">Choisir cet abonnement</button>
                    </div>
                </div>
                <!-- Pro Plan -->
                <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="single-pricing single-pricing-white">
                        <div class="price-head">
                            <h2>HELLO PME PRO</h2>
                        </div>
                        <span class="price-label">Best</span>
                        <h1 class="price mt-5">20 000 fcfa</h1>
                        <h5>1 mois</h5>
                        <ul>
                            <li>Appels d’offres : Tous pays, Tous secteurs</li>
                            <li>Opportunités de financement</li>
                            <li>Match-making automatique financement</li>
                            <li>Evènements et réseautage</li>
                            <li>3 utilisateurs</li>
                        </ul>
                        <button onclick="openModal('Abonnement Standard', 20000)">Choisir cet abonnement</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Structure -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Choisissez votre durée d'abonnement</h2>
            <form id="subscriptionForm">
                <label>
                    <input type="radio" name="duration" value="1 mois" required> 1 mois
                </label>
                <label>
                    <input type="radio" name="duration" value="3 mois"> 3 mois
                </label>
                <label>
                    <input type="radio" name="duration" value="6 mois"> 6 mois
                </label>
                <label>
                    <input type="radio" name="duration" value="1 an"> 1 an
                </label>
                <button type="submit">Confirmer l'abonnement</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(planName, price) {
            const modal = document.getElementById("myModal");
            modal.style.display = "block";

            const form = document.getElementById("subscriptionForm");
            form.onsubmit = function (event) {
                event.preventDefault();
                const duration = form.duration.value;
                alert(`Vous avez choisi le plan ${planName} à ${price} FCFA pour une durée de ${duration}`);
                closeModal();
            };
        }

        function closeModal() {
            const modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // Close modal when clicking outside of the modal
        window.onclick = function (event) {
            const modal = document.getElementById("myModal");
            if (event.target == modal) {
                closeModal();
            }
        };
    </script>
</body>

@include('layouts.footer')
