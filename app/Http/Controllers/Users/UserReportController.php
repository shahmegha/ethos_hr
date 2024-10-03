<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UserReportsDataTable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
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

    public function index(UserReportsDataTable $dataTable)
    {
        $users = null;
        if(Auth::user()?->hasRole('Administrator')){
            $users = User::whereHas('roles', function ($query) {
                    return $query->where('name','!=', 'Administrator');
                })->orderBy('name')->get();
        }
        return $dataTable->render('users.reports',['users'=>$users]);
    }
}
