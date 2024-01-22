<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{

    public function topup(Request $request)
    {
        Wallet::create([
            'users_id' => Auth::user()->id,
            'credit' => $request->credit,
            'status' => 'proses'
        ]);
        return redirect()->back()->with('status', 'success topup');
    }

    public function topupFromBank(Request $request)
    {
        Wallet::create([
            'credit' => $request->credit,
            'users_id' => $request->users_id,
            'status' => 'selesai'
        ]);

        return redirect()->back()->with('status', "success topup to user");
    }

    public function withdrawAccept($id)
    {
        $wallet = Wallet::find($id);

        $wallet->update([
            'status' => 'withdrawal'
        ]);

        return redirect()->back()->with('status', 'success accept withdraw');
    }

    public function withdrawUser(Request $request)
    {
        Wallet::create([
            'debit' => $request->debit,
            'users_id' => Auth::user()->id,
            'status' => 'proses withdrawal'
        ]);

        return redirect()->back()->with('status', 'success withdraw');
    }

    public function transferToUser(Request $request)
    {
        $credit = $request->credit;

        Wallet::create([
            'credit' => $credit,
            'users_id' => $request->users_id,
            'status' => 'transfer'
        ]);

        Wallet::create([
            'debit' => $credit,
            'users_id' => Auth::user()->id,
            'status' => 'transfer'
        ]);

        return redirect()->back()->with('status', 'success transfer');
    }

    public function topupAccept($id)
    {
        $wallet = Wallet::find($id);

        $wallet->update([
            'status' => 'selesai'
        ]);

        return redirect()->back()->with('status', 'success accept topup');
    }
}
