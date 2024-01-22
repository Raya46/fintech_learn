@extends('template.temp_navbar')

@section('content')
    <div class="bg-base-200 w-full h-full">
        <div class="container mx-auto">
            <div class="flex-col justify-between items-center lg:flex-row card glass p-6 mb-10 relative">
                <div class="flex justify-center items-center">
                    <img src="https://daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                        class="rounded-full shadow-2xl w-[12rem] h-[12rem] object-cover" />
                    <div class="flex flex-col justify-center p-6">
                        <h1 class="text-5xl font-bold">{{ Auth::user()->name }}</h1>
                        <span class="rounded p-2 my-2 text-lg text-white">Rp. {{ number_format($saldo_user) }}</span>
                        <div class="w-64 carousel rounded-box">
                            <div class="carousel-item w-full">
                                <a href="#my_modal_topup" class="w-full p-4 bg-white text-black border-none">Topup</a>
                            </div>
                            <div class="carousel-item w-full">
                                <a href="#modal_transfer" class="w-full p-4 bg-white text-black border-none">Transfer</a>
                            </div>
                            <div class="carousel-item w-full">
                                <a href="#modal_withdraw" class="w-full p-4 bg-white text-black border-none">Withdrawal</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel rounded-box w-96 border border-gray-500">
                    <div class="carousel-item w-1/2">
                        <img src="https://daisyui.com/images/stock/photo-1559703248-dcaaec9fab78.jpg" class="w-full" />
                    </div>
                    <div class="carousel-item w-1/2">
                        <img src="https://daisyui.com/images/stock/photo-1565098772267-60af42b81ef2.jpg" class="w-full" />
                    </div>
                    <div class="carousel-item w-1/2">
                        <img src="https://daisyui.com/images/stock/photo-1572635148818-ef6fd45eb394.jpg" class="w-full" />
                    </div>
                    <div class="carousel-item w-1/2">
                        <img src="https://daisyui.com/images/stock/photo-1494253109108-2e30c049369b.jpg" class="w-full" />
                    </div>
                    <div class="carousel-item w-1/2">
                        <img src="https://daisyui.com/images/stock/photo-1550258987-190a2d41a8ba.jpg" class="w-full" />
                    </div>
                    <div class="carousel-item w-1/2">
                        <img src="https://daisyui.com/images/stock/photo-1559181567-c3190ca9959b.jpg" class="w-full" />
                    </div>
                    <div class="carousel-item w-1/2">
                        <img src="https://daisyui.com/images/stock/photo-1601004890684-d8cbf643f5f2.jpg" class="w-full" />
                    </div>
                </div>
            </div>

            @if (session('status'))
                <div class="toast toast-top toast-start z-20">
                    <div class="alert alert-success">
                        <div class="flex items-center gap-3">
                            <span class="text-white">{{ session('status') }}</span>
                            <div class="border rounded-full p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="fill-white" viewBox="0 0 16 16">
                                    <path
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            <div class="flex flex-col">
                <div class="flex flex-col lg:flex-row justify-center items-center gap-4">
                    @foreach ($products as $product)
                        <div class="card w-[25rem] bg-base-100 border border-gray-500 shadow-xl">
                            <figure><img src="{{ $product->photo }}" alt="Shoes" />
                            </figure>
                            <div class="flex flex-col p-4">
                                <h2 class="card-title">{{ $product->name }}</h2>
                                <div class="flex items-center gap-1">
                                    <span class="badge badge-accent my-2 p-3">{{ $product->category->name }}</span>
                                    <span class="badge badge-primary p-3">Stock: {{ $product->stock }}</span>

                                </div>
                                <span
                                    class="badge badge-secondary text-white text-lg p-4 font-bold">Rp{{ number_format($product->price) }}</span>

                                <div class="flex w-full justify-between mt-4">
                                    <form action="/buy-now" method="post" class="w-full flex mr-5">
                                        @csrf
                                        <input type="hidden" name="products_id" value="{{ $product->id }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <button type="submit" class="btn">Buy Now</button>
                                    </form>
                                    <div class="flex gap-1 justify-end">
                                        <form class="flex" action="/add-to-cart" method="post">
                                            @csrf
                                            <input type="text" value="1" min="1"
                                                class="input input-bordered w-1/2 max-w-xs" name="quantity" />
                                            <input type="hidden" name="products_id" value="{{ $product->id }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <button type="submit" class="btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="fill-green-400" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                                    <path
                                                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                </svg>
                                            </button>

                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

    <div class="modal" role="dialog" id="modal_transfer">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Transfer</h3>
            <form action="/transfer-to-user" method="post" class="flex flex-col">
                @csrf
                <div class="flex items-center gap-4">
                    <span>To</span>
                    <select class="select select-primary w-full max-w-xs" name="users_id">
                        @foreach ($nasabah as $ns)
                            <option value="{{ $ns->id }}">{{ $ns->name }}</option>
                        @endforeach
                    </select>
                    <span>Rp.</span>
                    <input type="number" name="credit" placeholder="Type here"
                        class="input input-bordered w-full max-w-xs" />
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn">Submit</button>
            </form>
            <a href="#" class="btn">Yay!</a>
        </div>
    </div>
    </div>

    </div>

    <div class="modal" role="dialog" id="my_modal_topup">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Topup Rp</h3>
            <form action="/topup" method="post">
                <input type="number" name="credit" value="10000" placeholder="Rp."
                    class="input input-bordered w-full max-w-xs mt-3" />
                <div class="modal-action">
                    @csrf
                    <button type="submit" class="btn">Submit</button>
            </form>
            <a href="#" class="btn">Close</a>
        </div>
    </div>
    </div>

    </div>

    <div class="modal" role="dialog" id="modal_withdraw">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Withdrawal</h3>
            <form action="/withdrawal-from-user" method="post">
                <input type="number" name="debit" value="10000" placeholder="Rp."
                    class="input input-bordered w-full max-w-xs mt-3" />
                <div class="modal-action">
                    @csrf
                    <button type="submit" class="btn">Submit</button>
            </form>
            <a href="#" class="btn">Close</a>
        </div>
    </div>
    </div>

    </div>
@endsection
