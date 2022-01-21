<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $title = "Master Produk";
        return view('admin.masterProduct', compact('user', 'title'));
    }

    public function add()
    {
        $user = Auth::user();
        $suppliers = Supplier::get();
        $categories = Category::get();
        $title = "Master Produk";
        return view('admin.addProduct', compact('user', 'title', 'suppliers', 'categories'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $suppliers = Supplier::get();
        $categories = Category::get();
        $product = Product::where('id', $id)->first();
        $title = "Master Produk";
        return view('admin.editProduct', compact('user', 'title', 'suppliers', 'categories', 'product'));
    }

    public function getAll()
    {
        $products = Product::get();
        $products = DB::table('product')
        ->leftJoin('category', 'product.category_id', '=', 'category.id')
        ->select('product.*', 'category.name as category_name')
        ->get();

        return Datatables::of($products)
        ->addIndexColumn()
        ->addColumn('aksi',function($product){
            $out ='<center>';
            $out .='<a href="'.route('product.edit', $product->id).'" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-pen" style="color:white"></i></a>&nbsp;';
            $out .='<button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteProduct('.$product->id.')"><i class="fas fa-trash-alt" style="color:white"></i></button>&nbsp;';
            $out .='</center>';
            return $out;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'nameProduct' => 'required|unique:product,name',
            'supplierProduct' => 'required',
            'categoryProduct' => 'required',
            'buyPriceProduct' => 'required',
            'sellPriceProduct' => 'required',
            'quantityProduct' => 'required',
            'descriptionProduct' => 'required'
        ]);

        $file = $request->file('imageProduct');
        if ($file) {
            $file_name = time() . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $file_name);
            $query = Product::create([
                'name' => $validation["nameProduct"],
                'supplier_id' => $validation["supplierProduct"],
                'category_id' => $validation["categoryProduct"],
                'description' => $validation["descriptionProduct"],
                'buy_price' => $validation["buyPriceProduct"],
                'sell_price' => $validation["sellPriceProduct"],
                'quantity' => $validation["quantityProduct"],
                'image' => $file_name
            ]);

            if ($query) {
                Alert::success('Selamat', 'Produk berhasil disimpan');
            }else{
                Alert::error('Error', 'Produk gagal disimpan');
            }
            return redirect('/product');
        }

    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            'nameProduct' => 'required|unique:product,name',
            'supplierProduct' => 'required',
            'categoryProduct' => 'required',
            'buyPriceProduct' => 'required',
            'sellPriceProduct' => 'required',
            'quantityProduct' => 'required',
            'descriptionProduct' => 'required'
        ]);

        $file = $request->file('imageProduct');
        if ($file) {
            $product = Product::where('id', $request->idProduct)->first();
            if (Storage::exists('public/uploads/'.$product->image)) {
                Storage::delete('public/uploads/'.$product->image);
            }
            $file_name = time() . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $file_name);
            $query = Product::where('id', $request->idProduct)
            ->update([
                'name' => $validation["nameProduct"],
                'supplier_id' => $validation["supplierProduct"],
                'category_id' => $validation["categoryProduct"],
                'description' => $validation["descriptionProduct"],
                'buy_price' => $validation["buyPriceProduct"],
                'sell_price' => $validation["sellPriceProduct"],
                'quantity' => $validation["quantityProduct"],
                'image' => $file_name
            ]);
        }else{
            $query = Product::where('id', $request->idProduct)
            ->update([
                'name' => $validation["nameProduct"],
                'supplier_id' => $validation["supplierProduct"],
                'category_id' => $validation["categoryProduct"],
                'description' => $validation["descriptionProduct"],
                'buy_price' => $validation["buyPriceProduct"],
                'sell_price' => $validation["sellPriceProduct"],
                'quantity' => $validation["quantityProduct"]
            ]);
        }

        if ($query) {
            Alert::success('Selamat', 'Produk berhasil disimpan');
        }else{
            Alert::error('Error', 'Produk gagal disimpan');
        }
        return redirect('/product');
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        if (Storage::exists('public/uploads/'.$product->image)) {
            Storage::delete('public/uploads/'.$product->image);
        }
        $query = Product::where('id', $id)->delete();
        if ($query) {
            return response()->json([
                'success' => 'Produk berhasil dihapus!'
            ]);
        }
    }
}
