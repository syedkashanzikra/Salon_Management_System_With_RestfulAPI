<?php

namespace App\Http\Controllers;

use App\Models\Modules;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Permission';

        // module name
        $this->module_name = 'permission';
    }

    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $roles = Role::get();
        $modules = Modules::all();
        $permissions = Permission::get();
        $module_action = 'List';

        return view('permission-role.permissions', compact('roles', 'permissions', 'module_title', 'module_name', 'module_action', 'modules'));

    }

    public function store(Request $request, Role $role_id)
    {
        // if (env('IS_DEMO')) {
        //     return redirect()->back()->with('error', __('messages.permission_denied'));
        // }

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = Permission::get()->pluck('name')->toArray();
        $role_id->revokePermissionTo($permissions);
        foreach ($request->permission as $permission => $roles) {
            $pr = Permission::findOrCreate($permission);
            $role_id->permissions()->syncWithoutDetaching([$pr->id]);
        }

        return redirect()->route('backend.permission-role.list')->withSuccess(__(__('permission-role.save_form')));
    }

    public function reset_permission($role_id)
    {

        $message = __('messages.reset_form', ['form' => __('page.lbl_role')]);
        try {
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            $role = Role::find($role_id);

            $permissions = Permission::get()->pluck('name')->toArray();

            if ($role) {

                $role->permissions()->detach();

            }
        } catch (\Exception $th) {
        }

        return response()->json(['status' => true, 'message' => $message]);
    }
}
