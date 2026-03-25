<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @inertiaHead
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    @vite(['resources/scss/app.scss'])
</head>

<body class="bg-body-tertiary">
    @inertia

    @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
</body>

</html>
