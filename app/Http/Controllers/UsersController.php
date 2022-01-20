<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class UsersController extends Controller
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
        $title = "Master Users";
        return view('admin.masterUsers', compact('user', 'title'));
    }

    public function getAll()
    {
        $users = DB::table('users')
        ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.name as role')
        ->get();

        return Datatables::of($users)
        ->addIndexColumn()
        ->addColumn('aksi',function($user){
            if ($user->role_id == 1) {
                return '<center><button type="button" class="btn btn-sm btn-default" title="Admin" disabled>ADMIN</button></center>';
            }else{
                $out ='<center>';
                $out .='<button type="button" class="btn btn-sm btn-warning" title="Edit" onclick="editUser('.$user->id.')"><i class="fas fa-pen" style="color:white"></i></button>&nbsp;';
                $out .='<button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteUser('.$user->id.')"><i class="fas fa-trash-alt" style="color:white"></i></button>&nbsp;';
                $out .='</center>';
                return $out;
            }
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function getById($id)
    {
        $user = DB::table('users')
        ->where('users.id', $id)
        ->first();

        return json_encode($user);
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'nameUser' => 'required',
            'emailUser' => 'email',
            'passwordUser' => 'min:6'
        ]);

        $query = User::create([
            'name' => $validation["nameUser"],
            'email' => $validation["emailUser"],
            'password' => bcrypt($validation["passwordUser"]),
            'role_id' => 2
        ]);

        if ($query) {
            Alert::success('Selamat', 'User berhasil disimpan');
        }else{
            Alert::error('Error', 'User gagal disimpan');
        }
        return redirect('/users');

    }

    public function update(Request $request)
    {
        if ($request->passwordUser) {
            $validation = $request->validate([
                'nameUser' => 'required',
                'emailUser' => 'email',
                'passwordUser' => 'min:6'
            ]);

            $query = User::where('id',$request->idUser)
            ->update([
                'name' => $validation["nameUser"],
                'email' => $validation["emailUser"],
                'password' => $validation["passwordUser"]
            ]);
        }else{
            $validation = $request->validate([
                'nameUser' => 'required',
                'emailUser' => 'email'
            ]);

            $query = User::where('id',$request->idUser)
            ->update([
                'name' => $validation["nameUser"],
                'email' => $validation["emailUser"]
            ]);
        }

        if ($query) {
            Alert::success('Selamat', 'User berhasil disimpan');
        }else{
            Alert::error('Error', 'User gagal disimpan');
        }
        return redirect('/users');

    }

    public function delete($id)
    {
        $query = User::where('id', $id)->delete();
        if ($query) {
            return response()->json([
                'success' => 'User berhasil dihapus!'
            ]);
        }
    }
}
