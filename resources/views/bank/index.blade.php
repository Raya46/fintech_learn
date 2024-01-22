@extends('template.temp_navbar')

@section('dropdown-modal')
    <li><a href="#modal_topup_from_bank">Topup</a></li>
@endsection

@section('content')
    <div class="bg-base-200 w-full h-full">
        <div class="container mx-auto">
            <div class="flex flex-col p-4">
                <div class="flex flex-col justify-between lg:flex-row gap-4">
                    <div class="flex flex-col p-4 border border-gray-500 rounded-lg w-full">
                        <span class="card-title">Credit Bank</span>
                        <span>Rp. {{ $creditBank }}</span>
                    </div>
                    <div class="flex flex-col p-4 border border-gray-500 rounded-lg w-full">
                        <span class="card-title">Debit Bank</span>
                        <span>Rp. {{ $debitBank }}</span>
                    </div>
                    <div class="flex flex-col p-4 border border-gray-500 rounded-lg w-full">
                        <span class="card-title">Nasabah (Siswa)</span>
                        <span>{{ $nasabah->count() }}</span>
                    </div>
                </div>
                <div class="flex flex-col justify-between mt-5 w-full glass rounded-lg lg:flex-row p-5 gap-5">
                    <div class="flex flex-col w-full">
                        <span class="mt-2 text-center text-xl font-bold mb-3">Request Topup</span>
                        @foreach ($walletBank as $wb)
                            @if ($wb->credit != 0 && $wb->status == 'proses')
                                <div class="flex bg-base-200 p-3 rounded-lg items-center my-2 justify-between px-5">
                                    <div class="flex flex-col">
                                        <span>Rp.{{ $wb->credit }}</span>
                                        <span class="badge badge-outline">{{ $wb->user->name }}</span>
                                    </div>
                                    <form action="/topup-accept/{{ $wb->id }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-neutral">Accept</button>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="text-center text-xl font-bold mt-2 mb-3">Withdrawal</span>
                        @foreach ($walletBank as $wb)
                            @if ($wb->debit != 0 && $wb->status == 'proses withdrawal')
                                <div class="flex bg-base-200 p-3 rounded-lg items-center justify-between my-2 px-5">
                                    <div class="flex flex-col">
                                        <span>Rp. {{ $wb->debit }}</span>
                                        <span class="badge badge-outline">{{ $wb->user->name }}</span>
                                    </div>
                                    <form action="/withdrawal-accept/{{ $wb->id }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-neutral">Accept</button>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="text-center text-xl font-bold mt-2 mb-3">Transfer</span>
                        <div class="flex justify-between gap-2">
                            <div class="flex flex-col w-full">
                                @foreach ($walletBank as $wb)
                                    @if ($wb->debit != 0 && $wb->status == 'transfer')
                                        <div class="flex bg-base-200 p-3 rounded-lg items-center justify-between my-2 px-5">
                                            <div class="flex flex-col w-full">
                                                <span class="w-full">- {{ $wb->debit }}</span>
                                                <div class="flex gap-2">
                                                    <span class="badge badge-primary">From</span>
                                                    <span class="badge badge-outline">{{ $wb->user->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="flex flex-col w-full">
                                @foreach ($walletBank as $wb)
                                    @if ($wb->credit != 0 && $wb->status == 'transfer')
                                        <div class="flex bg-base-200 p-3 rounded-lg items-center justify-between my-2 px-5">
                                            <div class="flex flex-col w-full">
                                                <span class="w-full">+ {{ $wb->credit }}</span>
                                                <div class="flex gap-2">
                                                    <span class="badge badge-secondary">To</span>
                                                    <span class="badge badge-outline">{{ $wb->user->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="text-center text-xl font-bold mt-2 mb-3">Spend</span>
                        @foreach ($walletBank as $wb)
                            @if ($wb->debit != 0 && $wb->status == 'selesai')
                                <div class="flex bg-base-200 p-3 rounded-lg items-center justify-between my-2 px-5">
                                    <div class="flex flex-col">
                                        <span>Rp. {{ $wb->debit }}</span>
                                        <span class="badge badge-outline">{{ $wb->user->name }}</span>
                                    </div>
                                    <span class="btn btn-neutral">{{ $wb->status }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>



    <div class="modal" role="dialog" id="modal_topup_from_bank">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Topup</h3>
            <form action="/topup-from-bank" method="post" class="flex flex-col">
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
@endsection
