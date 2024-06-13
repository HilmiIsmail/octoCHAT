<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="{{ Storage::url('octoCHAT.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])



    {{-- CDN FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- CDN SWEET ALERT 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>


    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased" style="font-family: 'Poppins', sans-serif;">


    {{-- cambiar el font family de mi pagina --}}
    <x-banner />

    <div class="min-h-screen bg-gray-100">

        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script>
        Livewire.on('mensaje', txt => {
            Swal.fire({
                icon: 'success',
                title: txt,
                showConfirmButton: false,
                timer: 2500,
                toast: true,
                position: "top-end",
                background: '#8379BE',
                iconColor: '#ffff',
                color: '#ffff',
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }

            });
        })
        Livewire.on('confirmacionBorrar', (postId) => {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3da2d4",
                cancelButtonColor: "#EB497B",
                confirmButtonText: "Sí, ¡bórralo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatchTo('show-post', 'borrado', postId);
                }
            });
        })

        Livewire.on('confirmar', postId => {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3da2d4",
                cancelButtonColor: "#EB497B",
                confirmButtonText: "Sí, ¡bórralo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatchTo('home', 'borrarOk', postId)
                }
            });
        })
    </script>

    @if (session('mensaje'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('mensaje') }}',
                showConfirmButton: false,
                timer: 2500,
                toast: true,
                position: "top-end",
                background: '#8379BE',
                iconColor: '#ffff',
                color: '#ffff',
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }

            });
        </script>
    @endif

</body>

</html>
