<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @inertiaHead
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    @vite(['resources/scss/app.scss', 'resources/js/app.ts'])
</head>

<body class="bg-body-tertiary" style="display:none">
    @inertia
    {{-- @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"]) --}}

    <script>
        window.onload = () => {
            document.body.removeAttribute('style')
        }
    </script>
</body>

</html>
