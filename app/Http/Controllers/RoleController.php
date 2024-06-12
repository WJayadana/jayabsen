<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view role permission|create role permission|edit role permission|delete role permission', ['only' => ['index']]);
        $this->middleware('permission:create role permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit role permission', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete role permission', ['only' => ['destroy']]);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        $permissions = Permission::all();
        return view('website.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->name ]);
        $role->syncPermissions($request->permission);

        toastr('Role Created Successfully', 'success', 'Role', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        //Query untuk mengambil permission yang telah dimiliki oleh role terkait
        $hasPermission = DB::table('role_has_permissions')->select('permissions.name')->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')->where('role_id', $role->id)->get()->pluck('name')->all();
        return view('website.role.edit', compact('role', 'permissions', 'hasPermission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update(['name' => $request->name ]);
        $role->syncPermissions($request->permission);

        toastr('Role Updated Successfully', 'success', 'Role', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)    {
        $role->delete();
        toastr('Role Deleted Successfully', 'success', 'Role', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('roles.index');
    }

    public function datatable()
    {
        $roles = Role::orderBy('created_at', 'DESC');

        return DataTables::of($roles)
            ->addIndexColumn()
            ->editColumn('created_at', function($roles) {
                return Carbon::create($roles->createad_at)->format('d F Y');
            })
            ->addColumn('action', function($roles){
                $action = null;

                if(auth()->user()->hasPermissionTo('edit role permission')) {
                    $action .= '<a href="'.route('roles.edit', $roles->id).'" class="btn btn-warning btn-sm m-1"><i class="fas fa-edit"></i> </a>';
                }

                if(auth()->user()->hasPermissionTo('delete role permission')) {
                    $action .= '<button onclick="deleteConfirm(\''.$roles->id.'\')" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>
                    <form method="POST" action="'.route('roles.destroy', $roles->id).'" style="display:inline-block;" id="submit_'.$roles->id.'">
                        '.method_field('delete').csrf_field().'
                    </form>';
                }

                return empty($action) ? '-' : $action;
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}
