<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Blog System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Make sure html and body take full height */
        html, body {
            height: 100%;
            margin: 0;
        }
        /* Center container with flex */
        .center-container {
            display: flex;
            justify-content: center;  /* horizontal center */
            align-items: center;      /* vertical center */
            height: 100vh;            /* viewport height */
            background-color: #f3f4f6; /* tailwind's bg-gray-100 */
            font-family: 'Figtree', sans-serif;
        }
        /* The white card container */
        .card {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -2px rgb(0 0 0 / 0.05);
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="center-container">
        <div class="card">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
