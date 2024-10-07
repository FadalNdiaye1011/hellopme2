<div class="flex flex-wrap -mx-3 mb-5">
    <div class="w-full max-w-full px-3 mb-6  mx-auto">
        <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
            <div class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                <!-- card body  -->
                <div class="flex-auto block py-8 pt-6 px-9">
                    <div class="overflow-x-auto">
                        <table class="w-full my-0 align-middle text-dark border-neutral-200">
                            <thead class="align-bottom">
                                <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                    <th class="pb-3 text-start min-w-[175px]">Libelle</th>
                                    <th class="pb-3 text-start min-w-[100px]">Nom Responsable</th>
                                    <th class="pb-3 text-start pr-12 min-w-[175px]">Phone Responsable</th>
                                    <th class="pb-3 text-start pr-12 min-w-[175px]">Type finances</th>
                                    <th class="pb-3 text-start pr-12 min-w-[175px]">Declaration</th>
                                    <th class="pb-3 text-start pr-12 min-w-[100px]"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($finances as $finance)
                                @php
                                $truncated_description = Str::of($finance->declaration)->words(5, ' ...');
                                $prescripteur = App\Models\Prescripteur::where('finance_id', $finance->id)->first();
                                if(empty($prescripteur))
                                continue;
                                $url = asset('img/logo-shredded.png');
                                $prescripteur->logo = ($prescripteur->logo) ? Storage::disk('s3')->url('prescripteurs/logos/'. $prescripteur->logo) : $url;
                                @endphp
                                <tr class="border-b border-dashed last:border-b-0">
                                    <td class="p-3 pl-0">
                                        <div class="flex items-center">
                                            <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                <img src="{{$prescripteur->logo}}" class="w-[50px] h-[50px] inline-block shrink-0 rounded-2xl" alt="">
                                            </div>
                                            <div class="flex flex-col justify-start">
                                                <p class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-lg/normal text-secondary-inverse hover:text-primary"> {{ $prescripteur->libelle }} </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3 pr-0">
                                        <span class="font-semibold text-light-inverse text-md/normal">{{ $prescripteur->nom_responsable }}</span>
                                    </td>
                                    <td class="p-3 pr-0">
                                        <span class="font-semibold text-light-inverse text-md/normal">{{ $prescripteur->phone_responsable }}</span>
                                    </td>
                                    <td class="p-3 pr-0">
                                        <span class="font-semibold text-light-inverse text-md/normal">{{ $finance->type_finance }}</span>
                                    </td>
                                    <td class="p-3 pr-0">
                                        <span class="font-semibold text-light-inverse text-md/normal">{{ $truncated_description }}</span>
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right flex items-center justify-start h-full">
                                        <a href="{{ route('service.create', [$finance->id]) }}" class="group relative inline-block">
                                            <button class="focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="#2E4057"><path d="M14.1213 10.4792C13.7308 10.0886 13.0976 10.0886 12.7071 10.4792L12 11.1863C11.2189 11.9673 9.95259 11.9673 9.17154 11.1863C8.39049 10.4052 8.39049 9.13888 9.17154 8.35783L14.8022 2.72568C16.9061 2.24973 19.2008 2.83075 20.8388 4.46875C23.2582 6.88811 23.3716 10.7402 21.1792 13.2939L19.071 15.4289L14.1213 10.4792ZM3.16113 4.46875C5.33452 2.29536 8.66411 1.98283 11.17 3.53116L7.75732 6.94362C6.19523 8.50572 6.19523 11.0384 7.75732 12.6005C9.27209 14.1152 11.6995 14.1611 13.2695 12.7382L13.4142 12.6005L17.6568 16.8431L13.4142 21.0858C12.6331 21.8668 11.3668 21.8668 10.5858 21.0858L3.16113 13.6611C0.622722 11.1227 0.622722 7.00715 3.16113 4.46875Z"></path></svg>
                                            </button>
                                            <span
                                                class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-[#2E4057] rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Service
                                            </span>
                                        </a>

                                        <a href="{{ route('rate-tariff.create', [$finance->id]) }}" class="group relative inline-block">
                                            <button class="focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="green"><path d="M22.0049 7.99979H13.0049C12.4526 7.99979 12.0049 8.4475 12.0049 8.99979V14.9998C12.0049 15.5521 12.4526 15.9998 13.0049 15.9998H22.0049V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979H21.0049C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V7.99979ZM15.0049 10.9998H18.0049V12.9998H15.0049V10.9998Z"></path></svg>
                                            </button>
                                            <span
                                                class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-green-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Tarif
                                            </span>
                                        </a>

                                        <a href="{{ route('finances.show', [$finance->id]) }}" class="group relative inline-block">
                                            <button class="focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="#FFC800">
                                                    <path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path>
                                                </svg>
                                            </button>
                                            <span
                                                class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-yellow-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Details
                                            </span>
                                        </a>
                                        <a href="{{ route('finances.edit', [$finance->id]) }}"
                                            class="group relative inline-block">
                                            <button class="focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="blue">
                                                    <path d="M9.24264 18.9967H21V20.9967H3V16.754L12.8995 6.85453L17.1421 11.0972L9.24264 18.9967ZM14.3137 5.44032L16.435 3.319C16.8256 2.92848 17.4587 2.92848 17.8492 3.319L20.6777 6.14743C21.0682 6.53795 21.0682 7.17112 20.6777 7.56164L18.5563 9.68296L14.3137 5.44032Z"></path>
                                                </svg>
                                            </button>
                                            <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-blue-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">edit</span>
                                        </a>

                                        {!! Form::open(['route' => ['finances.destroy', $finance->id], 'method' => 'delete']) !!}
                                        <div class="group relative inline-block">

                                            {!! Form::button('<svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="red">
                                                <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM9 11V17H11V11H9ZM13 11V17H15V11H13ZM9 4V6H15V4H9Z"></path>
                                            </svg>', ['type' => 'submit', 'group relative inline-block', 'onclick' => "return confirm('Are you sure ?')"]) !!}
                                            <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-red-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Supprimer</span>
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mb-4 flex justify-center space-x-4 mt-7">
                            {{ $finances->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
