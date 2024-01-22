<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <div class="bg-base-200 w-full h-full">
        <div class="container mx-auto">
            <div class="flex items-center justify-between p-4">
                <a href="/" class="btn">
                    <div class="bg-white rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="fill-black" viewBox="0 0 16 16">
                            <path
                                d="M.5 3.5A.5.5 0 0 1 1 4v3.248l6.267-3.636c.52-.302 1.233.043 1.233.696v2.94l6.267-3.636c.52-.302 1.233.043 1.233.696v7.384c0 .653-.713.998-1.233.696L8.5 8.752v2.94c0 .653-.713.998-1.233.696L1 8.752V12a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5m7 1.133L1.696 8 7.5 11.367zm7.5 0L9.196 8 15 11.367z" />
                        </svg>
                    </div>

                    <span class="mx-2">Back</span>
                </a>
                <div class="flex gap-3">
                    @if (Auth::user()->roles_id != 4)
                        <a href="/history" class="btn">History Pembelian</a>
                    @else
                        <a href="/history" class="btn">History Pembelian</a>
                        <a href="/history?type=topup" class="btn">History Topup</a>
                        <a href="/cart" class="btn">Cart</a>
                    @endif
                </div>
            </div>

            @yield('content')
        </div>
    </div>

</body>

</html>
