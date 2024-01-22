<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function download(Request $request)
    {
        $order_code = $request->type;
        $reports = Transaction::with('product')->where('order_code', $order_code)->get();
        $wallets = Wallet::where('users_id', Auth::user()->id)->get();
        $transactionsAll = Transaction::with('product', 'user')->where('users_id', Auth::user()->id)->where('status', 'dibayar')->get()->groupBy('order_code');
        if ($request->type == 'topup') return view('siswa.download_topup', compact('wallets'));
        if ($request->type == '') return view('download', compact('transactionsAll'));
        return view('download_percode', compact('reports'));
    }

    public function cart()
    {
        $wallet = Wallet::where('users_id', Auth::user()->id)->where('status', 'selesai')->get();
        $credit = $wallet->sum('credit');
        $debit = $wallet->sum('debit');
        $saldo_user = $credit - $debit;
        $transactionKeranjang = Transaction::with('product')->where('users_id', Auth::user()->id)->where('status', 'dikeranjang')->get();
        return view('siswa.cart', compact('transactionKeranjang', 'saldo_user'));
    }

    public function history(Request $request)
    {
        $wallets = Wallet::where('users_id', Auth::user()->id)->get();
        $transactions = Transaction::with('product')->where('users_id', Auth::user()->id)->where('status', 'dibayar')->get()->groupBy('order_code');
        $transactionsAll = Transaction::with('product', 'user')->where('status', 'dibayar')->get()->groupBy('order_code');
        if ($request->type == 'topup') return view('siswa.history_topup', compact('wallets'));
        return view('history', compact('transactions', 'transactionsAll'));
    }

    public function addToCart(Request $request)
    {
        $same_transaction = Transaction::where("products_id", $request->products_id)->where("users_id", Auth::user()->id)->where("status", "dikeranjang")->first();
        if ($same_transaction) {
            $sum_quantity = $same_transaction->quantity += $request->quantity;
            $same_transaction->update([
                "quantity" => $sum_quantity,
            ]);
        } else {
            Transaction::create([
                "users_id" => Auth::user()->id,
                "products_id" => $request->products_id,
                "status" => "dikeranjang",
                "order_code" => "INV_" . Auth::user()->id . now()->format("dmYHis"),
                "price" => $request->price,
                "quantity" => $request->quantity
            ]);
        }


        return redirect('/')->with('status', 'success add to cart');
    }

    public function cancelCart($id)
    {
        $transaction = Transaction::find($id);

        $transaction->delete();

        return redirect()->back();
    }

    public function buyNow(Request $request)
    {
        $wallet = Wallet::where('users_id', Auth::user()->id)->where('status', 'selesai')->get();
        $credit = $wallet->sum('credit');
        $debit = $wallet->sum('debit');
        $saldo_user = $credit - $debit;

        if ($saldo_user < $request->price) return redirect()->back()->with('status', 'uang kurang');

        Transaction::create([
            'users_id' => Auth::user()->id,
            'products_id' => $request->products_id,
            'status' => 'dibayar',
            'order_code' => 'INV_' . Auth::user()->id . now()->format('dmYHis'),
            'price' => $request->price,
            'quantity' => 1
        ]);

        Wallet::create([
            'users_id' => Auth::user()->id,
            'debit' => $request->price * 1,
            'status' => 'selesai'
        ]);

        $product = Product::where('id', $request->products_id)->first();

        $product->update([
            'stock' => $product->stock - 1
        ]);

        return redirect('/')->with('status', 'success buy product');
    }

    public function buyFromCart()
    {
        $wallet = Wallet::where('users_id', Auth::user()->id)->first();
        $transactionKeranjang = Transaction::with("product")->where("users_id", Auth::user()->id)->where("status", "dikeranjang")->get();
        $totalBayar = 0;
        foreach ($transactionKeranjang as $ts) {
            $totalBayar = $ts->price * $ts->quantity;
            $product_buyyed = $ts->product;
            $stock = $ts->product->stock;
            $buyyed = $ts->quantity;
            $new_stock = $stock - $buyyed;
            $product_buyyed->stock = $new_stock;
            $product_buyyed->save();
        }

        Transaction::where('users_id', Auth::user()->id)
            ->where('status', 'dikeranjang')
            ->update([
                'status' => 'dibayar',
                'order_code' => 'INV_' . Auth::user()->id . now()->format('dmYHis'),
            ]);
        $wallet->update([
            'debit' => $wallet->debit + $totalBayar,
        ]);
        return redirect()->back()->with('status', 'success buy product from cart');
    }
}
