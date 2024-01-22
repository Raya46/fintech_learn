@extends('template.temp_wtnavbar')

@section('content')
    <div class="card glass">
        <div class="card-body">
            <div class="flex items-center justify-center text-2xl">
                <span class="bg-base-100 p-4 rounded-lg">History Pembelian</span>
            </div>
            @if (Auth::user()->roles != 'siswa')
                @foreach ($transactionsAll as $order_code => $tk)
                    @php
                        $timestamp = '';
                        $totalBayar = 0;
                    @endphp
                    <div class="card bg-base-100 p-6 mt-4">
                        <div class="flex gap-3 items-center">
                            <span class="text-2xl font-bold text-white">
                                {{ $order_code }}
                            </span>
                            <a href="/download?type={{ $order_code }}" target="_blank" class="bg-white rounded-full p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="fill-black" viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                </svg>
                            </a>
                        </div>

                        <div class="flex justify-between items-center mt-2">
                            <div class="flex flex-col justify-center gap-1">
                                @foreach ($tk as $t)
                                    @php
                                        $timestamp = $t->updated_at;
                                        $totalBayar += $t->product->price * $t->quantity;
                                    @endphp
                                    <span>{{ $t->product->name }} Rp. {{ number_format($t->product->price) }}
                                        {{ $t->quantity }}x</span>
                                @endforeach
                                <div class="flex mt-2">
                                    <span class="badge badge-outline">Total Bayar Rp.
                                        {{ number_format($totalBayar) }}</span>
                                    <span class="badge badge-outline">{{ $t->user->name }}</span>
                                </div>
                                <span class="text-sm text-gray-500 mt-2">{{ $timestamp }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($transactions as $order_code => $tk)
                    @php
                        $timestamp = '';
                        $totalBayar = 0;
                    @endphp
                    <div class="card bg-base-100 p-6 mt-4">
                        <div class="flex gap-3 items-center">
                            <span class="text-2xl font-bold text-white">
                                {{ $order_code }}
                            </span>
                            <a href="/download?type={{ $order_code }}" target="_blank" class="bg-white rounded-full p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="fill-black" viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                </svg>
                            </a>
                        </div>

                        <div class="flex justify-between items-center mt-2">
                            <div class="flex flex-col justify-center gap-1">
                                @foreach ($tk as $t)
                                    @php
                                        $timestamp = $t->updated_at;
                                        $totalBayar += $t->product->price * $t->quantity;
                                    @endphp
                                    <span>{{ $t->product->name }} Rp. {{ $t->product->price }}
                                        {{ $t->quantity }}x</span>
                                @endforeach
                                <span class="badge badge-outline">Total Bayar Rp. {{ $totalBayar }}</span>
                                <span class="text-sm text-gray-500 mt-2">{{ $timestamp }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
    <div class="btm-nav bg-transparent">
        <a href="/download" target="_blank">Download All</a>
    </div>
@endsection
