<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403 - Forbidden</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .text-9xl {
            font-size: 12rem;
        }

        @media(max-width: 768px) {
            .text-9xl {
                font-size: 6rem;
            }

            .text-6xl {
                font-size: 2rem;
            }

            .text-2xl {
                font-size: 1rem;
                line-height: 1.2rem;
            }

            .py-8 {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }

            .px-6 {
                padding-left: 1.2rem;
                padding-right: 1.2rem;
            }

            .mr-6 {
                margin-right: 0.5rem;
            }

            .px-12 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-r from-purple-300 to-blue-200">
    <div class="w-full min-h-screen flex items-center justify-center">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg pb-8">
            <div class="border-t border-gray-200 text-center pt-8">
                <h1 class="text-9xl font-bold text-purple-400">403</h1>
                <h1 class="text-6xl font-medium py-8">Forbidden</h1>
                <p class="text-2xl pb-8 px-12 font-medium">Oops! It seems like you are not allowed to access this page.
                </p>
                <a href="{{ route('home') }}"
                    class="bg-gradient-to-r from-purple-400 to-blue-500 hover:from-pink-500 hover:to-orange-500 text-white font-semibold px-6 py-3 rounded-md mr-6">
                    HOME
                </a>
                <a href=""
                    class="bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-500 text-white font-semibold px-6 py-3 rounded-md">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</body>

</html>
