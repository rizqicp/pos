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

class ConsumerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $title = "Produk";
        $products = Product::get();
        return view('consumer.index', compact('user', 'title', 'products'));
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
        return view('consumer.transaction', compact('user', 'title', 'products'));
    }

    public function getAll()
    {
        $transactions = DB::table('transaction')
        ->leftJoin('product', 'transaction.product_id', '=', 'product.id')
        ->select(
            'transaction.*',
            'product.name as product_name',
            'product.sell_price as product_sell_price'
        )
        ->where('transaction.user_id', Auth::user()->id)
        ->orderBy('date', 'DESC')
        ->get();

        return Datatables::of($transactions)
        ->addIndexColumn()
        ->addColumn('total_price',function($transaction){
            return $transaction->quantity * $transaction->product_sell_price;
        })
        ->addColumn('aksi',function($transaction){
            $out ='<center>';
            $out .='<button type="button" class="btn btn-sm btn-success" title="Edit" onclick="viewTransaction('.$transaction->id.')"><i class="fas fa-eye" style="color:white"></i></button>&nbsp;';
            $out .='</center>';
            return $out;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

}
