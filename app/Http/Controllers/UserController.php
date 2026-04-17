<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Roles;
use App\Http\Requests\UserRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $route = "users";
    protected $page_title = "Utilisateurs";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'users-list'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $listes = User::orderBy('id', 'desc')->get();
        $add_button_title = "Ajouter un utilisateur";
        $heading = "Liste des utilisateurs";
        $table_headers = ['Actions', 'Prénom(s)', 'Nom', 'Email', 'Role', 'Active'];
        $table_bodies = ['prenoms', 'nom', 'email', 'role_nom', 'actived'];

        return view('pages.utilisateurs.index', compact('listes', 'heading', 'add_button_title', 
        'table_headers', 'table_bodies'))->with(['page_title' => $this->page_title, 'route' => $this->route]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heading = "Ajouter un utilisateur";
        $roles = [null => 'Choisir...'] + Roles::pluck('name', 'id')->all();
        return view('pages.utilisateurs.create', compact('roles', 'heading'))->with(['page_title' => $this->page_title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'users-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        
        User::create($validated);

        return redirect('users')->with('success', 'Utlisateur ajouté avec succes!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userAuth = auth()->user();
        if (!$userAuth->can('permission', [User::class, 'users-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $heading = "Modifier un utilisateur";
        $user = User::findOrFail($id);
        $roles = [null => 'Choisir...'] + Roles::pluck('name', 'id')->all();

        return view('pages.utilisateurs.edit', compact('user', 'roles', 'heading'))->with(['page_title' => $this->page_title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $userAuth = auth()->user();
        if (!$userAuth->can('permission', [User::class, 'users-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }
        
        $user = User::findOrFail($id);
        
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $validated['is_active'] = $request->is_active;
        
        $user->update($validated);

        return redirect('/users')->with('success', 'Modification effectuée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $userAuth = auth()->user();
        if (!$userAuth->can('permission', [User::class, 'users-delete'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        try {
            $user = User::findOrFail($id);
            $user->is_active = 0;
            $user->save();

            if ($request->ajax())
            return \Response::make('Archivage effectué avec succès.', 200);
            else
                return redirect('/users')->with('success', 'Suppression effectuée avec succès.');
        }
        catch (QueryException $e) {
            if ($request->ajax())
                return \Response::make('Erreur lors de l\'archivage de cet enregistrement.', 403);
            else
                return \Redirect::back()->with('error_msg','Erreur lors de l\'archivage de cet enregistrement.');
        }
    }
}
