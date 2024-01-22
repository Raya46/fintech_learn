@extends('template.temp_download')

@section('content')
    @foreach ($wallets as $wallet)
        @if ($wallet->credit != 0)
            <div class="card bg-base-100 p-6 mt-4">
                <div class="flex justify-between items-center">
                    <div class="flex flex-col">
                        <span class="card-title font-bold">
                            Rp. {{ $wallet->credit }}
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
@endsection
