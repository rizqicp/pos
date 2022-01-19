<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
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
            $out ='<center>';
            $out .='<button type="button" class="btn btn-sm btn-warning" title="Edit" data-edit-id="'.$user->id.'"><i class="fas fa-pen" style="color:white"></i></button>&nbsp;';
            $out .='<button type="button" class="btn btn-sm btn-danger" title="Delete" data-delete-id="'.$user->id.'"><i class="fas fa-trash-alt" style="color:white"></i></button>&nbsp;';
            $out .='</center>';
            return $out;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }
}
