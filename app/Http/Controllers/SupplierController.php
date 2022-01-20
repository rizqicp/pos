<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Supplier;

class SupplierController extends Controller
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
        $title = "Master Supplier";
        return view('admin.masterSupplier', compact('user', 'title'));
    }

    public function getAll()
    {
        $suppliers = Supplier::get();

        return Datatables::of($suppliers)
        ->addIndexColumn()
        ->addColumn('aksi',function($supplier){
            $out ='<center>';
            $out .='<button type="button" class="btn btn-sm btn-warning" title="Edit" onclick="editSupplier('.$supplier->id.')"><i class="fas fa-pen" style="color:white"></i></button>&nbsp;';
            $out .='<button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteSupplier('.$supplier->id.')"><i class="fas fa-trash-alt" style="color:white"></i></button>&nbsp;';
            $out .='</center>';
            return $out;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function getById($id)
    {
        $supplier = Supplier::where('id', $id)
        ->first();

        return json_encode($supplier);
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'nameSupplier' => 'required',
            'phoneSupplier' => 'required',
            'addressSupplier' => 'required'
        ]);

        $query = Supplier::create([
            'name' => $validation["nameSupplier"],
            'phone' => $validation["phoneSupplier"],
            'address' => $validation["addressSupplier"]
        ]);

        if ($query) {
            Alert::success('Selamat', 'Supplier berhasil disimpan');
        }else{
            Alert::error('Error', 'Supplier gagal disimpan');
        }
        return redirect('/supplier');

    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            'nameSupplier' => 'required',
            'phoneSupplier' => 'required',
            'addressSupplier' => 'required'
        ]);

        $query = Supplier::where('id', $request->idSupplier)->update([
            'name' => $validation["nameSupplier"],
            'phone' => $validation["phoneSupplier"],
            'address' => $validation["addressSupplier"]
        ]);

        if ($query) {
            Alert::success('Selamat', 'Supplier berhasil disimpan');
        }else{
            Alert::error('Error', 'Supplier gagal disimpan');
        }
        return redirect('/supplier');
    }

    public function delete($id)
    {
        $query = Supplier::where('id', $id)->delete();
        if ($query) {
            return response()->json([
                'success' => 'Supplier berhasil dihapus!'
            ]);
        }
    }
}
