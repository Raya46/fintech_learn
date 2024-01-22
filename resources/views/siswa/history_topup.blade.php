@extends('template.temp_wtnavbar')

@section('content')
    <div class="card glass">
        <div class="card-body">
            <div class="flex items-center justify-center text-2xl">
                <span class="bg-base-100 p-4 rounded-lg">History Pembelian</span>
            </div>
            @foreach ($wallets as $wallet)
                @if ($wallet->credit != 0)
                    <div class="card bg-base-100 p-6 mt-4">
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <span class="card-title font-bold">
                                    Rp. {{ number_format($wallet->credit) }}
                                </span>
                                <span class="text-sm text-gray-500">{{ $wallet->updated_at }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="badge badge-outline p-3">{{ $wallet->status }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>

    </div>
    <div class="btm-nav bg-transparent">
        <a href="/download?type=topup" target="_blank">Download All</a>
    </div>
@endsection
