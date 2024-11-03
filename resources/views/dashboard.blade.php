<x-app-layout>
    <div class="flex flex-col md:flex-row p-6 bg-gray-200 dark:bg-gray-900">
        <div
            class="w-full md:w-1/3 p-6 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 rounded-lg shadow-2xl flex flex-col items-center space-y-6 h-[400px] overflow-y-auto">
            <div class="w-full flex justify-between items-center mb-4">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ __('User profile picture') }}"
                    class="w-16 h-16 rounded-full shadow-2xl">

                <div class="text-right text-white ml-auto">
                    <p class="text-xl font-semibold">
                        {{ Auth()->user()->name }}
                    </p>

                    <span id="reloj"
                        class="bg-gray-200 text-black text-xs font-semibold py-1 px-3 rounded-full shadow inline-flex items-center mt-2">
                        <i class="fa-solid fa-clock mr-1"></i>
                        <span id="hora" class="w-[75px] text-center">--:--:--</span>
                    </span>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-white mb-4">
                <i class="fa-solid fa-file-lines mr-2"></i>
                Generar Reporte
            </h2>

            <button type="button"
                class="w-full bg-red-600 text-white rounded-lg py-3 flex items-center justify-center shadow-md hover:shadow-lg transform transition-all hover:scale-105">
                <i class="fas fa-exclamation-circle mr-2"></i>
                Reporte de Problemas
            </button>
            <button type="button"
                class="w-full bg-green-600 text-white rounded-lg py-3 flex items-center justify-center shadow-md hover:shadow-lg transform transition-all hover:scale-105">
                <i class="fas fa-clock mr-2"></i>
                Reporte de Canales
            </button>
            <button type="button"
                class="w-full bg-blue-600 text-white rounded-lg py-3 flex items-center justify-center shadow-md hover:shadow-lg transform transition-all hover:scale-105">
                <i class="fas fa-forward mr-2"></i>
                Reporte de Funciones
            </button>
        </div>

        <div class="w-full md:w-2/3 pl-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl p-5 mb-6">
                <form class="w-full mx-auto">
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Search Mockups, Logos..." required autofocus />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search</button>
                    </div>
                </form>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-4">
                    <i class="fa-solid fa-info-circle mr-1"></i>
                    Utiliza el buscador para encontrar información detallada sobre un canal.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-5 flex items-center">
                    Canales con Problemas
                    <span
                        class="ml-2 inline-flex items-center justify-center w-7 h-7 text-white bg-primary-600 rounded-full">
                        2
                    </span>
                </h3>
                <ul class="space-y-4">
                    <li
                        class="bg-gray-100 dark:bg-gray-700 rounded-lg p-5 shadow-2xl flex items-center justify-between">
                        <div class="flex items-center flex-1">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/Logotipo_de_TV_Azteca.png"
                                alt="TV Azteca" class="w-16 h-16 object-contain object-center mr-4">
                            <div class="flex flex-col flex-1">
                                <div class="flex items-center">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                        101 TV Azteca
                                    </h4>
                                </div>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span
                                        class="bg-blue-200 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-md flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        14:30
                                    </span>
                                    <span
                                        class="bg-green-200 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-md flex items-center">
                                        <i class="fas fa-folder-open mr-1"></i>
                                        CDN TELMEX
                                    </span>
                                    <span
                                        class="bg-green-200 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-md flex items-center">
                                        <i class="fas fa-tv mr-1"></i>
                                        HLS
                                    </span>
                                    <span
                                        class="bg-yellow-200 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-md flex items-center">
                                        <i class="fas fa-circle-exclamation mr-1"></i>
                                        En revisión
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class="text-white bg-green-600 hover:bg-green-700 rounded-lg px-2 py-1.5 transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                <i class="fa-solid fa-circle-check"></i>
                                Solucionado
                            </button>
                        </div>
                    </li>

                    <li
                        class="bg-gray-100 dark:bg-gray-700 rounded-lg p-5 shadow-2xl flex items-center justify-between">
                        <div class="flex items-center flex-1">
                            <img src="https://seeklogo.com/images/C/Canal_2-logo-49A780603D-seeklogo.com.png"
                                alt="TV Azteca" class="w-16 h-16 object-contain object-center mr-4">
                            <div class="flex flex-col flex-1">
                                <div class="flex items-center">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                        102 Las Estrellas
                                    </h4>
                                </div>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span
                                        class="bg-blue-200 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-md flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        15:55
                                    </span>
                                    <span
                                        class="bg-green-200 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-md flex items-center">
                                        <i class="fas fa-folder-open mr-1"></i>
                                        CDN CEF+
                                    </span>
                                    <span
                                        class="bg-green-200 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-md flex items-center">
                                        <i class="fas fa-computer mr-1"></i>
                                        DASH
                                    </span>
                                    <span
                                        class="bg-red-200 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-md flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Pendiente
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class="text-white bg-green-600 hover:bg-green-700 rounded-lg px-2 py-1.5 transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                <i class="fa-solid fa-circle-check"></i>
                                Solucionado
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function actualizarReloj() {
            const hora = document.getElementById('hora');
            const ahora = new Date();
            hora.textContent = ahora.toLocaleTimeString();
        }
        setInterval(actualizarReloj, 1000);
        actualizarReloj();
    </script>
</x-app-layout>
