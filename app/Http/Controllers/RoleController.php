<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    protected $subheading = "roles";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'roles-list'])) {
            return back()->with("error_msg", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $datas = $roles = Role::orderBy('id', 'desc')->get();
        $add_button_title = "Ajouter un role";
        $heading = "Liste des roles";
        $table_headers = ['Actions', 'Nom'];
        $table_bodies = ['nom'];

        return view('pages.roles.index', compact('roles', 'heading', 'add_button_title', 'datas', 'table_headers', 'table_bodies'))->with('subheading', $this->subheading);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'roles-create'])) {
            return back()->with("error_msg", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $heading = "Ajouter un role";
        $permissions = Permission::get();
        $permission_categories = \DB::table("permissions")
            ->select("categorie")
            ->groupBy("categorie")
            ->get();

        return view('pages.roles.create', compact('permissions', 'permission_categories', 'heading'))->with('subheading', $this->subheading);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'roles-create'])) {
            return back()->with("error_msg", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $validated = $request->validated();
        
        $role = Role::create($validated);

        foreach ($request->permission as $perm) {
            $role->permissions()->attach($perm);
        }

        return redirect('roles')->with('success', 'Role ajouté avec succes!');
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
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'roles-update'])) {
            return back()->with("error_msg", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $heading = "Modifier un permission";

        $role = Role::findOrFail($id);
        $permissions = Permission::get();

        $permission_categories = \DB::table("permissions")
            ->select("categorie")
            ->groupBy("categorie")
            ->get();

        return view('pages.roles.edit', compact('role', 'permissions', 'permission_categories', 'heading'))->with('subheading', $this->subheading);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'roles-update'])) {
            return back()->with("error_msg", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $role = Role::findOrFail($id);
        
        $validated = $request->validated();

        foreach ($request->permission as $perm) {
            if(!$role->permissions->contains($perm)) {
                $role->permissions()->attach($perm);
            }
        }

        $role->update($validated);

        return redirect('/roles')->with('success', 'Modification effectuée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'roles-destroy'])) {
            return back()->with("error_msg", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        try {
            $role = Role::findOrFail($id);
            $role->delete();

            if ($request->ajax())
            return \Response::make('Archivage effectué avec succès.', 200);
            else
                return redirect('/roles')->with('success', 'Suppression effectuée avec succès.');
        }
        catch (QueryException $e) {
            if ($request->ajax())
                return \Response::make('Erreur lors de l\'archivage de cet enregistrement.', 403);
            else
                return \Redirect::back()->with('error_msg', 'Erreur lors de l\'archivage de cet enregistrement.');
        }
    }
}
