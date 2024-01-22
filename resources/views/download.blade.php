@extends('template.temp_download')

@section('content')
    @foreach ($transactionsAll as $order_code => $tk)
        @php
            $timestamp = '';
            $totalBayar = 0;
        @endphp
        <div class="card bg-base-100 p-6 mt-4">
            <span class="text-2xl font-bold text-white">
                {{ $order_code }}
            </span>

            <div class="flex justify-between items-center mt-2">
                <div class="flex flex-col justify-center gap-1">
                    @foreach ($tk as $t)
                        @php
                            $timestamp = $t->updated_at;
                            $totalBayar += $t->product->price * $t->quantity;
                        @endphp
                        <span>{{ $t->product->name }} Rp. {{ $t->product->price }} {{ $t->quantity }}x</span>
                    @endforeach
                    <div class="flex">
                        <span class="badge badge-outline">Total Bayar Rp. {{ $totalBayar }}</span>
                        <span class="badge badge-outline">{{ $t->user->name }}</span>
                    </div>
                    <span class="text-sm text-gray-500 mt-2">{{ $timestamp }}</span>
                </div>
            </div>
        </div>
    @endforeach
@endsection
