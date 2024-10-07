@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-4xl font-extrabold mb-4">Services pour <span class="text-blue-200">{{ $acteurFinance->libelle }}</span></h2>
        <p class="text-blue-100">Sélectionnez les services que cet acteur financier propose et fournissez des critères si nécessaire :</p>
    </div>

    <form action="{{ route('acteur-services.store', $acteurFinance->id) }}" method="POST" class="bg-white shadow-xl rounded-xl p-8 space-y-8">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="flex flex-col items-start p-6 bg-gray-50 rounded-lg hover:shadow-lg transition duration-300 transform hover:scale-105">
                    <div class="flex items-center">
                        <input type="checkbox" id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}"
                            class="w-6 h-6 text-blue-500 border-gray-300 rounded-lg focus:ring-blue-600 service-checkbox"
                            {{ $acteurFinance->services->contains($service->id) ? 'checked' : '' }}>
                        <label for="service_{{ $service->id }}" class="ml-4 text-lg font-medium text-gray-700">{{ $service->libelle }}</label>
                    </div>
                    <div class="mt-4 w-full hidden" id="commentaire_{{ $service->id }}">
                        <label for="comment_{{ $service->id }}" class="block text-gray-600">Critère :</label>
                        <textarea id="comment_{{ $service->id }}" name="commentaires[{{ $service->id }}]" rows="3"
                            class="w-full px-4 py-2 border rounded-lg text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $acteurFinance->services->contains($service->id) ? $acteurFinance->services->find($service->id)->pivot->commentaire : '' }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-end space-x-6 mt-8">
            <button type="submit" class="py-3 px-8 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105">Valider</button>
            <a href="{{ route('acteur-finances.index') }}" class="py-3 px-8 bg-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-400 transition duration-300 transform hover:scale-105">Annuler</a>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.service-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const commentaireDiv = document.getElementById('commentaire_' + this.value);
            if (this.checked) {
                commentaireDiv.classList.remove('hidden');
            } else {
                commentaireDiv.classList.add('hidden');
            }
        });

        // Trigger for checked checkboxes on page load
        if (checkbox.checked) {
            document.getElementById('commentaire_' + checkbox.value).classList.remove('hidden');
        }
    });
</script>
@endsection
