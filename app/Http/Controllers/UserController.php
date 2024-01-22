<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {
        if (!Auth::check()) return view('dashboard');

        $products = Product::all();
        $transactionsKeranjang = Transaction::where('status', 'dikeranjang')->with('product')->get();
        $wallet = Wallet::where('users_id', Auth::user()->id)->where('status', 'transfer')->orWhere('status', 'withdrawal')->orWhere('status', 'selesai')->get();
        $credit = $wallet->sum('credit');
        $debit = $wallet->sum('debit');
        $saldo_user = $credit - $debit;
        $total_bayar = 0;

        $walletBank = Wallet::with('user')->get();
        $walletSelesai = Wallet::where('status', 'selesai')->orWhere('status', 'transfer')->get();
        $creditBank = $walletSelesai->sum('credit');
        $debitBank = $walletSelesai->sum('debit');
        $nasabah = User::where('roles_id', 4)->get();
        $users = User::all();
        $roles = Role::all();

        $products = Product::all();
        $categories = Category::all();

        foreach ($transactionsKeranjang as $tk) {
            $total_bayar += $tk->product->price * $tk->quantity;
        }

        if (Auth::user()->roles_id == 1) return view('admin.index', compact('users', 'roles'));
        if (Auth::user()->roles_id == 2) return view('kantin.index', compact('products', 'categories'));
        if (Auth::user()->roles_id == 3) return view('bank.index', compact('walletBank', 'debitBank', 'creditBank', 'nasabah'));

        return view('siswa.index', compact('products', 'saldo_user', 'transactionsKeranjang', 'total_bayar', 'nasabah'));
    }

    public function getLogin()
    {
        return view('login');
    }

    public function getRegister()
    {
        return view('register');
    }

    public function postLogin(Request $request)
    {
        $validate = $request->validate([
            "name" => "required",
            "password" => "required",
        ]);

        if (!Auth::attempt($validate)) return redirect()->back();

        return redirect("/");
    }

    public function logout()
    {
        Session::flush();
        Auth::user();
        return view('dashboard');
    }

    public function postRegister(Request $request)
    {
        User::create([
            'name' => $request->name,
            'password' => $request->password,
            'roles_id' => 4
        ]);

        return redirect('/login');
    }

    public function postUser(Request $request)
    {
        User::create([
            'name' => $request->name,
            'password' => $request->password,
            'roles_id' => $request->roles_id,
        ]);

        return redirect()->back()->with('status', 'success create user');
    }

    public function putUser(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->password == '') {
            $user->update([
                'name' => $request->name,
                'password' => $user->password,
                'roles_id' => $request->roles_id,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'password' => $request->password,
                'roles_id' => $request->roles_id,
            ]);
        }

        return redirect()->back()->with('status', 'success update user');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->back()->with('status', 'success delete user');
    }
}
