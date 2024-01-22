@extends('template.temp_wtnavbar')

@section('content')
    @php
        $totalBayar = 0;
    @endphp
    <div class="card glass">
        <div class="card-body">
            <div class="flex items-center justify-center text-2xl">
                <span class="bg-base-100 p-4 rounded-lg mb-3">Your Cart</span>
            </div>
            @foreach ($transactionKeranjang as $tk)
                @php
                    $totalBayar += $tk->product->price * $tk->quantity;
                @endphp
                <div class="card bg-base-100">
                    <div class="flex items-center justify-between p-4">
                        <div class="flex flex-col">
                            <span class="card-title">{{ $tk->product->name }} ({{ $tk->quantity }}x)</span>
                            <span>Rp. {{ number_format($tk->product->price) }}</span>
                        </div>
                        <form action="/cancel-cart/{{ $tk->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">X</button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

    @if ($totalBayar == 0)
        <span></span>
    @elseif($totalBayar > $saldo_user)
        <div class="btm-nav bg-transparent">
            <span class="text-xl text-red-500">Saldo Kurang - Rp.{{ $totalBayar - $saldo_user }}</span>
        </div>
    @else
        <div class="btm-nav bg-transparent">
            <span class="text-xl">Total bayar: Rp. {{ number_format($totalBayar) }}</span>
            <form action="/buy-from-cart" method="post">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Buy</button>
            </form>
        </div>
    @endif
@endsection
