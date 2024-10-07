
<div class="w-full mb-12 px-4">
              <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
              >
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                  <div class="flex flex-wrap items-center">
                    <div
                      class="relative w-full px-4 max-w-full flex-grow flex-1"
                    >
                      <h3 class="font-semibold text-lg text-blueGray-700">
                        Secteur Activite Children
                      </h3>
                    </div>
                  </div>
                </div>
                <div class="block w-full overflow-x-auto">
                  <!-- Projects table -->
                  <table
                    class="items-center w-full border-collapse"
                  >
                    <thead>
                      <tr>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                          Libelle
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                            Secteur
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        ></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($secteurActiviteChildren as $secteurActiviteChild)
                        @php
                            $secteur = ($secteurActiviteChild->secteur_activite_id) ? \App\Models\SecteurActivite::find($secteurActiviteChild->secteur_activite_id) : "None";
                        @endphp
                      <tr>
                        <th
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center"
                        >
                          <span class="ml-3 font-bold text-blueGray-600 ">
                             {{ $secteurActiviteChild->libelle }}
                          </span>
                        </th>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            {{ $secteur->libelle }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right flex items-center justify-start h-full">
                            <a href="{{ route('secteur-activite-children.show', [$secteurActiviteChild->id]) }}" class="group relative inline-block">
                                <button class="focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="#FFC800"><path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path></svg>
                                </button>
                                <span
                                    class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-yellow-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100"
                                    >Details
                                </span
                                >
                            </a>
                                    <a href="{{ route('secteur-activite-children.edit', [$secteurActiviteChild->id]) }}"
                                    class="group relative inline-block">
                                        <button class="focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="blue"><path d="M9.24264 18.9967H21V20.9967H3V16.754L12.8995 6.85453L17.1421 11.0972L9.24264 18.9967ZM14.3137 5.44032L16.435 3.319C16.8256 2.92848 17.4587 2.92848 17.8492 3.319L20.6777 6.14743C21.0682 6.53795 21.0682 7.17112 20.6777 7.56164L18.5563 9.68296L14.3137 5.44032Z"></path></svg>
                                        </button>
                                        <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-blue-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">edit</span>
                                    </a>

                            {!! Form::open(['route' => ['secteur-activite-children.destroy', $secteurActiviteChild->id], 'method' => 'delete']) !!}
                                    <div class="group relative inline-block">

                                        {!! Form::button('<svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 24 24" fill="red"><path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM9 11V17H11V11H9ZM13 11V17H15V11H13ZM9 4V6H15V4H9Z"></path></svg>', ['type' => 'submit', 'group relative inline-block', 'onclick' => "return confirm('Are you sure ?')"]) !!}
                                        <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-red-700 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-100">Supprimer</span>
                                    </div>
                             {!! Form::close() !!}
                        </td>
                      </tr>

                      @endforeach
                    </tbody>
                  </table>
                    <div class="mb-4 flex justify-center space-x-4 mt-7">
                        {{ $secteurActiviteChildren->links('vendor.pagination.custom') }}
                    </div>
                </div>

              </div>
        </div>


        <script>
    document.addEventListener('click', function(e) {
        if (e.target.closest('.pagination a')) {
            e.preventDefault();
            var url = e.target.closest('.pagination a').href;

            // Appel Ajax pour charger les résultats de la page suivante
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                // Remplacer le contenu du tableau
                document.getElementById('secteur-list').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        }
    });
</script>




