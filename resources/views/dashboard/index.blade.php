@extends('layouts.app')

@section('content')



<div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
    <h1 class="text-2xl font-semibold">Dashboard</h1>
</div>

<!-- filter -->
<div class="flex items-center gap-2 px-4">
    <a href="{{ route('dashboard', ['filter' => 'all']) }}"
        class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#06B6D4] h-9 rounded-md px-3">
        <svg
            class="lucide lucide-rocket text-cyan-500 dark:text-cyan-400"
            stroke-linejoin="round"
            stroke-linecap="round"
            stroke-width="2"
            stroke="#06B6D4"
            fill="none"
            viewBox="0 0 24 24"
            height="22"
            width="22"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
            <path
                d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
            <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
            <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
        </svg>
        Tout
    </a>
    <a href="{{ route('dashboard', ['filter' => 'day']) }}"
        class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#60A5FA] h-9 rounded-md px-3">
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
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path>
            <path d="M18 14h-8"></path>
            <path d="M15 18h-5"></path>
            <path d="M10 6h8v4h-8V6Z"></path>
        </svg>
        Journée
    </a>
    <a href="{{ route('dashboard', ['filter' => 'week']) }}"
        class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#FACC14] h-9 rounded-md px-3">
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
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M15.5 3H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V8.5L15.5 3Z"></path>
            <path d="M15 3v6h6"></path>
        </svg>
        Semaine
    </a>
    <a href="{{ route('dashboard', ['filter' => 'month']) }}"
        class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#FB923C] h-9 rounded-md px-3">
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
            xmlns="http://www.w3.org/2000/svg">
            <polygon
                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
        </svg>
        Mois
    </a>
</div>
<!-- filter -->

<!-- State cards -->



<div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
    <!-- Bar chart card -->
    <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
        <!-- Card header -->
        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Databanks En cours de modification</h4>
        </div>
        <!-- en cours de modification -->
        <div class="relative h-[53vh] overflow-auto">
            <div class="w-full mb-12 px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <!-- Projects table -->
                        <table
                            class="items-center w-full border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                        Titre
                                    </th>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                        Description
                                    </th>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                        Type
                                    </th>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($databanksBeingModified as $databank)
                                @php
                                $none_entity = "None";
                                $truncated_titre = Str::of($databank->titre)->words(3, ' ...');
                                $truncated_description = Str::of($databank->description)->words(5, ' ...');
                                $type = ($databank->type_opportunity_id) ? \App\Models\TypeOpportunity::find($databank->type_opportunity_id) : null;
                                @endphp
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                                        <span class="ml-3 font-bold text-blueGray-600 ">
                                            {{ $truncated_titre }}
                                        </span>
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $truncated_description }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <i class="fas fa-circle text-orange-500 mr-2"></i>
                                        @if ($databank->typeOpportunity){{ $databank->typeOpportunity->libelle }} @endif
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        @if ($databank->etat === 'being_modified')
                                        <span class="badge bg-yellow-500 p-3 rounded-lg">En cours de modification</span>
                                        @elseif ($databank->etat === 'modified')
                                        <span class="badge bg-green-500 p-3 rounded-lg">Modifiée</span>
                                        @else
                                        <span class="badge bg-blue-500 p-3 rounded-lg">Non modifiée</span>
                                        @endif
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right flex items-center justify-start h-full">
                                        <a href="{{ route('databanks.show', [$databank->id]) }}" class="group relative inline-block">
                                            <button class="focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="#FFC800">
                                                    <path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path>
                                                </svg>
                                            </button>
                                            <span
                                                class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-yellow-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Details
                                            </span>
                                        </a>

                                        @role('admin|editor')
                                        <a href="{{ route('databanks.edit', [$databank->id]) }}" class="group relative inline-block">
                                            <button class="focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="blue">
                                                    <path d="M9.24264 18.9967H21V20.9967H3V16.754L12.8995 6.85453L17.1421 11.0972L9.24264 18.9967ZM14.3137 5.44032L16.435 3.319C16.8256 2.92848 17.4587 2.92848 17.8492 3.319L20.6777 6.14743C21.0682 6.53795 21.0682 7.17112 20.6777 7.56164L18.5563 9.68296L14.3137 5.44032Z"></path>
                                                </svg>
                                            </button>
                                            <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-blue-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">edit</span>
                                        </a>
                                        @endrole

                                        @if ($databank->etat !== 'being_modified')
                                        @role('admin|validator')
                                        <a href="{{ route('databanks.validate', [$databank->id]) }}" class="group relative inline-block">
                                            <button class="focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="green">
                                                    <path d="M4 3H17L20.7071 6.70711C20.8946 6.89464 21 7.149 21 7.41421V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM12 18C13.6569 18 15 16.6569 15 15C15 13.3431 13.6569 12 12 12C10.3431 12 9 13.3431 9 15C9 16.6569 10.3431 18 12 18ZM5 5V9H15V5H5Z"></path>
                                                </svg>
                                            </button>
                                            <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-green-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Sauvegarder</span>
                                        </a>
                                        @endrole
                                        {!! Form::open(['route' => ['databanks.destroy', $databank->id], 'method' => 'delete']) !!}
                                        <div class="group relative inline-block">

                                            {!! Form::button('<svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="red">
                                                <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM9 11V17H11V11H9ZM13 11V17H15V11H13ZM9 4V6H15V4H9Z"></path>
                                            </svg>', ['type' => 'submit', 'group relative inline-block', 'onclick' => "return confirm('Are you sure ?')"]) !!}
                                            <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-red-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Supprimer</span>
                                        </div>
                                        {!! Form::close() !!}

                                        @endif
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Doughnut chart card -->
    <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
        <!-- Card header -->
        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">diagramme</h4>
            <div class="flex items-center">
            </div>
        </div>
        <!-- Chart -->
        <div class="relative p-4 ">
            <canvas id="barChart"></canvas><!-- Canvas pour le graphique -->
        </div>
        <script>
            var ctx = document.getElementById('barChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($data['labels']),
                    datasets: [{
                        label: 'Data',
                        data: @json($data['data']),
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                },
            });
        </script>
    </div>
</div>

<div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
    <!-- total opportunite -->
    <div class="bg-white rounded-md dark:bg-darker flex justify-center items-center" x-data="{ isOn: false }">
        <!-- Card header -->
        <!-- <div class="flex items-center justify-between p-4 border-b dark:border-primary">
            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Total</h4>
        </div> -->
        <!-- Chart -->
         <div class="text-7xl text-[#677B44] border border-[#677B44] border-8 p-4 rounded-full">{{ $countOpportunitiesFiltered }}</div>
    </div>

    <!-- en cours de modification -->
    <div class="col-span-2 relative h-[53vh] bg-white overflow-auto">
         <!-- Card header -->
         <div class="flex items-center justify-between p-4 border-b dark:border-primary">
            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Opportunité publier</h4>
            <div class="flex items-center">
                <button
                    class="relative focus:outline-none"
                    x-cloak>
                    <div
                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"></div>
                    <div
                        class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                        :class="{ 'translate-x-0  bg-white dark:bg-primary-100': !isOn, 'translate-x-6 bg-primary-light dark:bg-primary': isOn }"></div>
                </button>
            </div>
        </div>
        <div class="w-full mb-12 px-4">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                </div>
                <div class="block w-full overflow-x-auto">
                    <!-- Projects table -->
                    <table
                        class="items-center w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Titre
                                </th>

                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Type
                                </th>

                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($opportunities as $databank)
                            @php
                            $none_entity = "None";
                            $truncated_titre = Str::of($databank->titre)->words(2, ' ...');
                            $truncated_description = Str::of($databank->description)->words(2, ' ...');
                            $type = ($databank->type_opportunity_id) ? \App\Models\TypeOpportunity::find($databank->type_opportunity_id) : null;
                            @endphp
                            <tr>
                                <th
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                                    <span class="ml-3 font-bold text-blueGray-600 ">
                                        {{ $truncated_titre }}
                                    </span>
                                </th>

                                <td
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <i class="fas fa-circle text-orange-500 mr-2"></i>
                                    @if ($databank->typeOpportunity){{ $databank->typeOpportunity->libelle }} @endif
                                </td>

                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right flex items-center justify-start h-full">
                                    <a href="{{ route('databanks.show', [$databank->id]) }}" class="group relative inline-block">
                                        <button class="focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="#FFC800">
                                                <path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path>
                                            </svg>
                                        </button>
                                        <span
                                            class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-yellow-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Details
                                        </span>
                                    </a>

                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
    <!-- Line chart card -->
    <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
        <!-- Card header -->
        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Databanks Modifier</h4>
            <div class="flex items-center">
                <button
                    class="relative focus:outline-none"
                    x-cloak>
                    <div
                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"></div>
                    <div
                        class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                        :class="{ 'translate-x-0  bg-white dark:bg-primary-100': !isOn, 'translate-x-6 bg-primary-light dark:bg-primary': isOn }"></div>
                </button>
            </div>
        </div>
        <!-- Chart -->
        <div class="relative h-[53vh] overflow-auto">
            <div class="overflow-x-auto">
                <div class="relative py-2">
                    <div class="w-full px-4">
                        <div
                            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                            <div class="rounded-t mb-0 px-4 py-3 border-0">
                            </div>
                            <div class="block w-full overflow-x-auto">
                                <!-- Projects table -->
                                <table
                                    class="items-center w-full border-collapse">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                                Titre
                                            </th>
                                            <th
                                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                                Description
                                            </th>
                                            <th
                                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                                Type
                                            </th>
                                            <th
                                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                                Status
                                            </th>
                                            <th
                                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($databanksModified as $databank)
                                        @php
                                        $none_entity = "None";
                                        $truncated_titre = Str::of($databank->titre)->words(3, ' ...');
                                        $truncated_description = Str::of($databank->description)->words(3, ' ...');
                                        $type = ($databank->type_opportunity_id) ? \App\Models\TypeOpportunity::find($databank->type_opportunity_id) : null;
                                        @endphp
                                        <tr>
                                            <th
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                                                <span class="ml-3 font-bold text-blueGray-600 ">
                                                    {{ $truncated_titre }}
                                                </span>
                                            </th>
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ $truncated_description }}
                                            </td>
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                <i class="fas fa-circle text-orange-500 mr-2"></i>
                                                @if ($databank->typeOpportunity){{ $databank->typeOpportunity->libelle }} @endif
                                            </td>
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                @if ($databank->etat === 'being_modified')
                                                <span class="badge bg-yellow-500 p-3 rounded-lg">En cours de modification</span>
                                                @elseif ($databank->etat === 'modified')
                                                <span class="badge bg-green-500 p-3 rounded-lg">Modifiée</span>
                                                @else
                                                <span class="badge bg-blue-500 p-3 rounded-lg">Non modifiée</span>
                                                @endif
                                            </td>
                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right flex items-center justify-start h-full">
                                                <a href="{{ route('databanks.show', [$databank->id]) }}" class="group relative inline-block">
                                                    <button class="focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="#FFC800">
                                                            <path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path>
                                                        </svg>
                                                    </button>
                                                    <span
                                                        class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-yellow-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Details
                                                    </span>
                                                </a>

                                                @role('admin|editor')
                                                <a href="{{ route('databanks.edit', [$databank->id]) }}" class="group relative inline-block">
                                                    <button class="focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="blue">
                                                            <path d="M9.24264 18.9967H21V20.9967H3V16.754L12.8995 6.85453L17.1421 11.0972L9.24264 18.9967ZM14.3137 5.44032L16.435 3.319C16.8256 2.92848 17.4587 2.92848 17.8492 3.319L20.6777 6.14743C21.0682 6.53795 21.0682 7.17112 20.6777 7.56164L18.5563 9.68296L14.3137 5.44032Z"></path>
                                                        </svg>
                                                    </button>
                                                    <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-blue-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">edit</span>
                                                </a>
                                                @endrole

                                                @if ($databank->etat !== 'being_modified')
                                                @role('admin|validator')
                                                <a href="{{ route('databanks.validate', [$databank->id]) }}" class="group relative inline-block">
                                                    <button class="focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="green">
                                                            <path d="M4 3H17L20.7071 6.70711C20.8946 6.89464 21 7.149 21 7.41421V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM12 18C13.6569 18 15 16.6569 15 15C15 13.3431 13.6569 12 12 12C10.3431 12 9 13.3431 9 15C9 16.6569 10.3431 18 12 18ZM5 5V9H15V5H5Z"></path>
                                                        </svg>
                                                    </button>
                                                    <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-green-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Sauvegarder</span>
                                                </a>
                                                @endrole
                                                {!! Form::open(['route' => ['databanks.destroy', $databank->id], 'method' => 'delete']) !!}
                                                <div class="group relative inline-block">

                                                    {!! Form::button('<svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="red">
                                                        <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM9 11V17H11V11H9ZM13 11V17H15V11H13ZM9 4V6H15V4H9Z"></path>
                                                    </svg>', ['type' => 'submit', 'group relative inline-block', 'onclick' => "return confirm('Are you sure ?')"]) !!}
                                                    <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-red-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Supprimer</span>
                                                </div>
                                                {!! Form::close() !!}

                                                @endif
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-md dark:bg-darker flex justify-center items-center" x-data="{ isOn: false }">
        <!-- Card header -->
        <!-- <div class="flex items-center justify-between p-4 border-b dark:border-primary">
            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Total</h4>
        </div> -->
        <!-- Chart -->
         <div class="text-7xl text-[#677B44] border border-[#677B44] border-8 p-4 rounded-full">{{ $countModified }}</div>
    </div>
</div>



@endsection
