<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\Module;
use App\Traits\UseQuery;
use Carbon\Carbon;
use DataTables;
use DB;

class PermissionController extends Controller
{
    use UseQuery;

    /**
     * Declare class instances
     * 
     */
    private $permissionModel;

    /**
     * Use constructor for initializing
     * 
     */
    public function __construct()
    {
        $this->permissionModel = new Permission();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permissions.index');
    }

    /**
     * Fetch a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        $permissionQuery = $this->query($this->permissionModel);
        $permissions = $permissionQuery->with('roles:id,name')
        ->get();
        
        return DataTables::of($permissions)
            ->addColumn('permission.roles', function($permission) {
                return $permission->roles;
            })
            ->addColumn('created_at', function($permission) {
                return Carbon::parse($permission->created_at)->format('d M Y, g:i a');
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
