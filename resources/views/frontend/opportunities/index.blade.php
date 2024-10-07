@include('layouts.header')

@section('content')
<body>
    <div class="content-head">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <h1 class="title">La plateforme de Développement des PME</h1>
                    <p class="description">Accédez à des opportunités d'affaires et de financement dans plus de 10 pays.</p>
                    <p class="nom-pays">
                        @foreach ($paysPartners as $pays_item)
                            @if($pays_item->opportunities_count > 0)
                            <a style="text-decoration:none; color:#89c026" href="{{ route('opportunities.search', ['pays_partner_id' => $pays_item->pays_partner_id]) }}">
                                <img class="" src="{{ asset('img/' . $pays_item->code . '.png') }}" style="width: 3%" alt="">
                                {{$pays_item->pays_name}}
                            </a>,&nbsp;
                            @endif
                        @endforeach
                        <b>+10 autres pays</b>
                    </p>
                </div>
                <div class="col-lg-5 col-md-5">
                    <img src="{{asset('img/head-img.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>

    <section class="section-last-opportunite">
    <div class="container">
        <p class="sub-title">Filtres opportunités ({{ $opportunities->total() }}) </p>
            <div class="flex items-center gap-2 mb-3">
            <button
                class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#60A5FA] h-9 rounded-md px-3"
            >
                <svg
                class="lucide lucide-newspaper text-blue-400 dark:text-blue-600"
                stroke-linejoin="round"
                stroke-linecap="round"
                stroke-width="2"
                stroke="#60A5FA"
                fill="none"
                viewBox="0 0 24 24"
                height="22"
                width="22"
                xmlns="http://www.w3.org/2000/svg"
                >
                <path
                    d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"
                ></path>
                <path d="M18 14h-8"></path>
                <path d="M15 18h-5"></path>
                <path d="M10 6h8v4h-8V6Z"></path>
                </svg>
                Appel d'offres
            </button>
            <button
                class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#FACC14] h-9 rounded-md px-3"
            >
                <svg
                class="lucide lucide-sticky-note text-yellow-400 dark:text-yellow-600"
                stroke-linejoin="round"
                stroke-linecap="round"
                stroke-width="2"
                stroke="#FACC14"
                fill="none"
                viewBox="0 0 24 24"
                height="22"
                width="22"
                xmlns="http://www.w3.org/2000/svg"
                >
                <path
                    d="M15.5 3H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V8.5L15.5 3Z"
                ></path>
                <path d="M15 3v6h6"></path>
                </svg>
                Financement
            </button>
            <button
                class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#FB923C] h-9 rounded-md px-3"
            >
                <svg
                class="lucide lucide-star text-orange-400 dark:text-orange-600"
                stroke-linejoin="round"
                stroke-linecap="round"
                stroke-width="2"
                stroke="#FB923C"
                fill="#FB923C"
                viewBox="0 0 24 24"
                height="22"
                width="22"
                xmlns="http://www.w3.org/2000/svg"
                >
                <polygon
                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                ></polygon>
                </svg>
                Evenements
            </button>
            </div>
        @if($opportunities->count() > 0)
            <div class="row group-card">
                @foreach ($opportunities as $opportunity)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        @include('./frontend.opportunities._opportunity_card')
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="pagination-container">
                {{ $opportunities->links() }}
            </div>
        @endif
    </div>
</section>
@extends('layouts.footer')
</body>
</html>
