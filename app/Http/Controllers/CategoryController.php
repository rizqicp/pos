<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;

class CategoryController extends Controller
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
        $title = "Master Kategori";
        return view('admin.masterCategory', compact('user', 'title'));
    }

    public function getAll()
    {
        $categories = Category::get();

        return Datatables::of($categories)
        ->addIndexColumn()
        ->addColumn('aksi',function($category){
            $out ='<center>';
            $out .='<button type="button" class="btn btn-sm btn-warning" title="Edit" onclick="editCategory('.$category->id.')"><i class="fas fa-pen" style="color:white"></i></button>&nbsp;';
            $out .='<button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteCategory('.$category->id.')"><i class="fas fa-trash-alt" style="color:white"></i></button>&nbsp;';
            $out .='</center>';
            return $out;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function getById($id)
    {
        $category = Category::where('id', $id)
        ->first();

        return json_encode($category);
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'nameCategory' => 'required'
        ]);

        $query = Category::create([
            'name' => $validation["nameCategory"]
        ]);

        if ($query) {
            Alert::success('Selamat', 'Kategori berhasil disimpan');
        }else{
            Alert::error('Error', 'Kategori gagal disimpan');
        }
        return redirect('/category');

    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            'nameCategory' => 'required'
        ]);

        $query = Category::where('id', $request->idCategory)
        ->update([
            'name' => $validation["nameCategory"]
        ]);

        if ($query) {
            Alert::success('Selamat', 'Kategori berhasil disimpan');
        }else{
            Alert::error('Error', 'Kategori gagal disimpan');
        }
        return redirect('/category');

    }

    public function delete($id)
    {
        $query = Category::where('id', $id)->delete();
        if ($query) {
            return response()->json([
                'success' => 'Kategori berhasil dihapus!'
            ]);
        }
    }
}
