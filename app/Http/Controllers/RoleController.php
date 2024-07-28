<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Module;
use App\Traits\UseQuery;
use DB;

class RoleController extends Controller
{
    use UseQuery;

    private $roleModel;
    private $moduleModel;

    public function __construct() {
        $this->roleModel = new Role();
        $this->moduleModel = new Module();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleQuery = $this->query($this->roleModel);
        $roles = $roleQuery->with('permissions', 'users')
            ->withCount('users')
            ->get();

        $moduleQuery = $this->query($this->moduleModel);
        $modules = $moduleQuery->with('permissions')
            ->get();

        return view('roles.index', compact('roles', 'modules'));
    }

    /**
     * Fetch users associated with the role
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetchUsers($roleId)
    {
        $roleQuery = $this->query($this->roleModel);
        $roles = $roleQuery->with('users')
        ->get();

        return DataTables::of($roles)
            ->addColumn('role.users', function($role) {
                return $role->users->full_name;
            })
            ->make(true);
    }

    /**
     * Show permissions associated with the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchPermissions($roleId)
    {
        //
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
        $request->validate([
            'name' => 'required|unique:roles'
        ]);

        DB::beginTransaction();
        try {
            $roleQuery = $this->query($this->roleModel);
            $role = $roleQuery->create([
                'name' => $request->name
            ]);

            $role->syncPermissions($request->permissions);
            DB::commit();

            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollback();

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $roleId
     * @return \Illuminate\Http\Response
     */
    public function show($roleId)
    {
        $roleQuery = $this->query($this->roleModel);
        $role = $roleQuery->with('permissions:id,name',)
            ->find($roleId);
        
        return view('roles.view', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($roleId)
    {
        $roleQuery = $this->query($this->roleModel);
        $role = $roleQuery->with('permissions:id')
            ->find($roleId);

        $moduleQuery = $this->query($this->moduleModel);
        $modules = $moduleQuery->with('permissions')
            ->get();

        return view('roles.edit', compact('role', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $roleId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roleId)
    {
        $request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($roleId)],
        ]);

        DB::beginTransaction();
        try {
            $roleQuery = $this->query($this->roleModel);
            $role = $roleQuery->find($roleId);
            $role->name = $request->name;
            $role->save();

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }

            DB::commit();

            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollback();

            return redirect()->back();
        }
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
