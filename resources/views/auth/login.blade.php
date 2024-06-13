<x-guest-layout>
    <main class="w-full flex ">
        <div
            class="relative flex-1 hidden items-center justify-center h-screen lg:flex  bg-[#8379BE] hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
            <div class="relative z-10 w-full max-w-md ">
                <a href="{{ route('home') }}">
                    <svg width="350px" height="350px" viewBox="0 0 400 400" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M89 291.829C136.178 351.39 120.825 251.8 131.321 234.688C140.473 219.763 168.426 226.711 171.721 206.889C177.405 172.654 133.482 157.233 189.418 101.103C197.701 92.7912 209.668 86.6025 221.737 89.9054C280.646 106.029 231.398 181.8 234.817 212.68C237.06 232.929 280.175 207.964 286.758 250.902C288.166 260.074 288.267 319.567 310.614 306.112"
                                stroke="#fff" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M180.818 241.289C197.31 262.581 151.352 274.541 171.482 300.386" stroke="#fff"
                                stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M208.33 237.879C209.788 263.541 217.552 279.329 208.717 306.068" stroke="#fff"
                                stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M236.742 248.165C276.468 246.211 234.958 294.947 257.199 306.068" stroke="#fff"
                                stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M226.73 156.053C227.429 153.522 227.198 150.751 227.433 148.098" stroke="#fff"
                                stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M205.816 156.053C206.412 153.077 206.282 150.035 206.282 146.961" stroke="#fff"
                                stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </g>
                    </svg>
                </a>
                <div class="mt-16 space-y-3">
                    <h3 class="text-white text-3xl font-bold">
                        ¡Únete a nuestra comunidad!

                    </h3>
                    <p class="text-white">
                        ¡Crea una cuenta ahora!
                    </p>
                    <div class="flex items-center -space-x-2 overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/women/79.jpg"
                            class="w-10 h-10 rounded-full border-2 border-white" />
                        <img src="https://api.uifaces.co/our-content/donated/xZ4wg2Xj.jpg"
                            class="w-10 h-10 rounded-full border-2 border-white" />
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-0.3.5&q=80&fm=jpg&crop=faces&fit=crop&h=200&w=200&s=a72ca28288878f8404a795f39642a46f"
                            class="w-10 h-10 rounded-full border-2 border-white" />
                        <img src="https://randomuser.me/api/portraits/men/86.jpg"
                            class="w-10 h-10 rounded-full border-2 border-white" />
                        <img src="https://images.unsplash.com/photo-1510227272981-87123e259b17?ixlib=rb-0.3.5&q=80&fm=jpg&crop=faces&fit=crop&h=200&w=200&s=3759e09a5b9fbe53088b23c615b6312e"
                            class="w-10 h-10 rounded-full border-2 border-white" />
                        <p class="text-sm text-white font-medium translate-x-5">
                            Únete a nuestros usuarios
                        </p>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 my-auto h-[500px]">
            </div>
        </div>
        <div class="flex-1 flex items-center justify-center h-screen">
            <div class="w-full max-w-md space-y-8 px-4 bg-white text-gray-600 sm:px-0">
                <div class="">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('path-to-your-logo/logo.svg') }}" width="150" class="lg:hidden" />
                    </a>
                    <div class="mt-5 space-y-2">
                        <h3 class="text-gray-800 text-2xl font-bold sm:text-3xl">
                            Iniciar sesión
                        </h3>
                        <p class="">
                            ¿No tienes una cuenta?
                            <a href="{{ route('register') }}" class="font-medium text-[#8379BE]">Registrar</a>
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-x-3">
                    <button
                        class="flex items-center justify-center py-2.5 border  hover:bg-gray-50 duration-150 active:bg-gray-100">
                        <img src="https://raw.githubusercontent.com/sidiDev/remote-assets/7cd06bf1d8859c578c2efbfda2c68bd6bedc66d8/google-icon.svg"
                            alt="Google" class="w-5 h-5" />
                    </button>

                    <button
                        class="flex items-center justify-center py-2.5 border  hover:bg-gray-50 duration-150 active:bg-gray-100">
                        <img src="https://raw.githubusercontent.com/sidiDev/remote-assets/0d3b55a09c6bb8155ca19f43283dc6d88ff88bf5/github-icon.svg"
                            alt="Github" class="w-5 h-5" />
                    </button>
                </div>
                <div class="relative">
                    <span class="block w-full h-px bg-gray-300"></span>
                    <p class="inline-block w-fit text-sm bg-white px-2 absolute -top-2 inset-x-0 mx-auto">
                        O continua con
                    </p>
                </div>
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="font-medium">Email</label>
                        <input type="email" id="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username"
                            class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm " />
                    </div>
                    <div>
                        <label class="font-medium">Contraseña</label>
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm " />
                    </div>
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <input type="checkbox" id="remember_me" name="remember"
                                class="rounded border-gray-300 text-[#8379BE] shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                        <button type="submit"
                            class="px-4 py-2 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] transition duration-300 ease-in-out">
                            {{ __('Iniciar sesión') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-guest-layout>
