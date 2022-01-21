<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexBuy()
    {
        $user = Auth::user();
        $title = "Transaksi Pembelian";
        $products = DB::table('product')
        ->leftJoin('category', 'product.category_id', '=', 'category.id')
        ->leftJoin('supplier', 'product.supplier_id', '=', 'supplier.id')
        ->select(
            'product.*',
            'category.name as category_name',
            'supplier.name as supplier_name'
        )
        ->get();
        return view('admin.buyTransaction', compact('user', 'title', 'products'));
    }

    public function indexSell()
    {
        $user = Auth::user();
        $title = "Transaksi Pembelian";
        $products = DB::table('product')
        ->leftJoin('category', 'product.category_id', '=', 'category.id')
        ->leftJoin('supplier', 'product.supplier_id', '=', 'supplier.id')
        ->select(
            'product.*',
            'category.name as category_name',
            'supplier.name as supplier_name'
        )
        ->get();
        $users = User::where('role_id', 2)->get();
        return view('admin.sellTransaction', compact('user', 'title', 'products', 'users'));
    }

    public function getAllBuy()
    {
        $transactions = DB::table('transaction')
        ->leftJoin('product', 'transaction.product_id', '=', 'product.id')
        ->leftJoin('category', 'product.category_id', '=', 'category.id')
        ->leftJoin('supplier', 'product.supplier_id', '=', 'supplier.id')
        ->select(
            'transaction.*',
            'product.name as product_name',
            'product.buy_price as product_buy_price',
            'category.name as category_name',
            'supplier.name as supplier_name'
        )
        ->where('transaction.user_id', 1)
        ->orderBy('date', 'DESC')
        ->get();

        return Datatables::of($transactions)
        ->addIndexColumn()
        ->addColumn('total_price',function($transaction){
            return $transaction->quantity * $transaction->product_buy_price;
        })
        ->addColumn('aksi',function($transaction){
            $out ='<center>';
            $out .='<button type="button" class="btn btn-sm btn-warning" title="Edit" onclick="editTransaction('.$transaction->id.')"><i class="fas fa-pen" style="color:white"></i></button>&nbsp;';
            $out .='<button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteTransaction('.$transaction->id.')"><i class="fas fa-trash-alt" style="color:white"></i></button>&nbsp;';
            $out .='</center>';
            return $out;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function getAllSell()
    {
        $transactions = DB::table('transaction')
        ->leftJoin('product', 'transaction.product_id', '=', 'product.id')
        ->leftJoin('category', 'product.category_id', '=', 'category.id')
        ->leftJoin('users', 'transaction.user_id', '=', 'users.id')
        ->select(
            'transaction.*',
            'product.name as product_name',
            'product.buy_price as product_buy_price',
            'category.name as category_name',
            'users.name as user_name'
        )
        ->where('users.role_id', 2)
        ->orderBy('date', 'DESC')
        ->get();

        return Datatables::of($transactions)
        ->addIndexColumn()
        ->addColumn('total_price',function($transaction){
            return $transaction->quantity * $transaction->product_buy_price;
        })
        ->addColumn('aksi',function($transaction){
            $out ='<center>';
            $out .='<button type="button" class="btn btn-sm btn-warning" title="Edit" onclick="editTransaction('.$transaction->id.')"><i class="fas fa-pen" style="color:white"></i></button>&nbsp;';
            $out .='<button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteTransaction('.$transaction->id.')"><i class="fas fa-trash-alt" style="color:white"></i></button>&nbsp;';
            $out .='</center>';
            return $out;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function getById($id)
    {
        $transactions = DB::table('transaction')
        ->leftJoin('product', 'transaction.product_id', '=', 'product.id')
        ->leftJoin('category', 'product.category_id', '=', 'category.id')
        ->leftJoin('supplier', 'product.supplier_id', '=', 'supplier.id')
        ->leftJoin('users', 'transaction.user_id', '=', 'users.id')
        ->select(
            'transaction.id as id',
            'transaction.quantity as quantity',
            'product.id as product_id',
            'product.name as product_name',
            'product.buy_price as product_buy_price',
            'category.name as category_name',
            'supplier.name as supplier_name',
            'users.id as user_id',
            'users.name as user_name'
        )
        ->where('transaction.id', $id)
        ->first();

        return json_encode($transactions);
    }





    public function create(Request $request)
    {
        $validation = $request->validate([
            'productTransaction' => 'required',
            'quantityTransaction' => 'required'
        ]);
        $product = Product::where('id', $validation["productTransaction"])->first();
        if ($request->userTransaction) {
            $userId = $request->userTransaction;
            Product::where('id', $validation["productTransaction"])
            ->update([
                'quantity' => $product->quantity - $validation["quantityTransaction"]
            ]);
        }else{
            $userId = Auth::user()->id;
            Product::where('id', $validation["productTransaction"])
            ->update([
                'quantity' => $product->quantity + $validation["quantityTransaction"]
            ]);
        }
        $query = Transaction::create([
            'user_id' => $userId,
            'product_id' => $validation["productTransaction"],
            'quantity' => $validation["quantityTransaction"]
        ]);

        if ($query) {
            Alert::success('Selamat', 'Transaksi berhasil disimpan');
        }else{
            Alert::error('Error', 'Transaksi gagal disimpan');
        }
        if (Auth::user()->role_id == 1) {
            if ($request->userTransaction) {
                return redirect('/transaction/sell');
            }else{
                return redirect('/transaction/buy');
            }
        }else{
            return redirect('/consumer/buy');
        }


    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            'productTransaction' => 'required',
            'quantityTransaction' => 'required'
        ]);
        $product = Product::where('id', $validation["productTransaction"])->first();
        $transaction = Transaction::where('id', $request->idTransaction)->first();
        if ($request->userTransaction) {
            Product::where('id', $validation["productTransaction"])
            ->update([
                'quantity' => $product->quantity - ($validation["quantityTransaction"] - $transaction->quantity)
            ]);
        }else{
            Product::where('id', $validation["productTransaction"])
            ->update([
                'quantity' => $product->quantity + ($validation["quantityTransaction"] - $transaction->quantity)
            ]);
        }

        $query = Transaction::where('id', $request->idTransaction)
        ->update([
            'product_id' => $validation["productTransaction"],
            'quantity' => $validation["quantityTransaction"]
        ]);

        if ($query) {
            Alert::success('Selamat', 'Transaksi berhasil disimpan');
        }else{
            Alert::error('Error', 'Transaksi gagal disimpan');
        }
        if (Auth::user()->role_id == 1) {
            if ($request->userTransaction) {
                return redirect('/transaction/sell');
            }else{
                return redirect('/transaction/buy');
            }
        }else{
            return redirect('/home');
        }
    }

    public function delete($id)
    {
        $transaction = Transaction::where('id', $id)->first();
        $product = Product::where('id', $transaction->product_id)->first();
        $user = User::where('id', $transaction->user_id)->first();
        if ($user->role_id == 1) {
            Product::where('id', $transaction->product_id)
            ->update([
                'quantity' => $product->quantity - $transaction->quantity
            ]);
        }else{
            Product::where('id', $transaction->product_id)
            ->update([
                'quantity' => $product->quantity + $transaction->quantity
            ]);
        }
        $query = Transaction::where('id', $id)->delete();
        if ($query) {
            return response()->json([
                'success' => 'Produk berhasil dihapus!'
            ]);
        }
    }
}
