<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Page</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <div class="flex items-center justify-center mb-4">
                <svg class="animate-spin h-10 w-10 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A8.005 8.005 0 0112 4.536v3.998L6 17.291zM20 12c0-6.627-5.373-12-12-12v4a8 8 0 018 8h4zm-4 4.536a8.005 8.005 0 01-6-15.755V2.536l6 4.203z"></path>
                </svg>
            </div>
            <p class="text-center text-gray-800 font-semibold">Loading...</p>
        </div>
    </div>
    <script>
        window.addEventListener('load', () => {
            const loader = document.querySelector('.bg-white');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }
        });
    </script>
</body>
</html>
