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
    <div class="navbar bg-base-100 sticky top-0 z-10">
        <div class="flex-1">
            <a href="/" class="btn btn-ghost text-xl">FintechUsk</a>
        </div>
        <div class="flex-none">
            @if (!Auth::check())
                <div class="flex gap-2">
                    <a href="/login" class="btn">Login</a>
                    <a href="/register" class="btn">Register</a>
                </div>
            @else
                @if (Auth::user()->roles_id == 3)
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS Navbar component"
                                    src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a href="/history">History</a></li>
                            @yield('dropdown-modal')
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </div>
                @elseif(Auth::user()->roles_id == 2)
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS Navbar component"
                                    src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a href="/history">History</a></li>
                            @yield('dropdown-modal')
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </div>
                @elseif (Auth::user()->roles_id == 1)
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS Navbar component"
                                    src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a href="/history">History</a></li>
                            <li><a href="/roles">Manage Roles</a></li>
                            <li><a href="/category">Manage Category</a></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="badge badge-sm indicator-item">{{ $transactionsKeranjang->count() }}</span>
                            </div>
                        </div>
                        <div tabindex="0"
                            class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
                            <div class="card-body">
                                <span class="font-bold text-lg">{{ $transactionsKeranjang->count() }} Items</span>
                                <span class="text-info">Subtotal: {{ $total_bayar }}</span>
                                <div class="card-actions">
                                    <a href="/cart" class="btn btn-primary btn-block">View cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS Navbar component"
                                    src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a href="/history">History</a></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </div>
                @endif

            @endif

        </div>
    </div>

    @yield('content')


</body>

</html>
