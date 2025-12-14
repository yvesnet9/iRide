<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        <!-- HEADER -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-green-700 mb-2">
                🚗 Véhicules EcoRide disponibles
            </h1>

            <p class="text-gray-600">
                Choisissez un véhicule respectueux de l’environnement pour vos déplacements.
            </p>
        </div>

        <!-- LISTE DES VEHICULES -->
        @if($vehicles->isEmpty())
            <div class="p-4 bg-yellow-100 text-yellow-800 rounded">
                Aucun véhicule n'est disponible pour le moment.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($vehicles as $vehicle)
                    <a href="{{ route('ecoride.show', $vehicle->id) }}"
                       class="block p-5 bg-white shadow-sm rounded-lg border border-gray-200
                              hover:shadow-lg hover:border-green-400 transition">

                        <!-- Nom -->
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                            {{ $vehicle->name }}
                        </h2>

                        <!-- Type -->
                        <span class="inline-block mb-2 px-3 py-1 text-sm rounded-full
                                     bg-green-100 text-green-700 font-semibold">
                            {{ ucfirst($vehicle->type) }}
                        </span>

                        <!-- Autonomie -->
                        <p class="text-gray-700 mt-2">
                            <strong>Autonomie :</strong>
                            {{ $vehicle->autonomy ? $vehicle->autonomy . ' km' : 'Non renseignée' }}
                        </p>

                        <!-- Disponibilité -->
                        <p class="text-green-600 font-semibold mt-4">
                            ✔ Disponible
                        </p>

                    </a>
                @endforeach

            </div>
        @endif

    </div>

</x-app-layout>
