<?php

namespace App\Http\Controllers;

use App\Models\CanalProspect;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\User;
use App\Models\Quartier;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    protected $subheading = "Client";

    public function index()
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'clients-list'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        } 

        $heading = "Liste des clients";
        $avatar_path = 'images/avatars/';

        $table_headers = array('Actions', 'Prénom','Nom','Quartier','Téléphone','Email');

        $clients = Client::orderBy('updated_at', 'desc')->get();

        return view('pages.clients.index',
            compact('heading', 'table_headers', 'clients', 'avatar_path'))
            ->with('$subheading', $this->subheading);
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'clients-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        } 

        $heading = "Ajouter un nouveau client";
        $liste_quartiers = [null => ''] + Quartier::pluck('nom_quartier', 'id')->all();
        $liste_canal_prospects = [null => ''] + CanalProspect::pluck('canal_prospect', 'id')->all();
        $liste_clients = [null => ''] + Client::get()->pluck('afficher_client', 'id')->all();

        return view(
            'pages.clients.client_form_create',
            compact('heading', 'liste_quartiers', 'liste_canal_prospects', 'liste_clients'))
            ->with('subheading', $this->subheading);
    }

    public function store(ClientRequest $request)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'clients-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        } 

        $validated = $request->validated();

//        $file_name = $validated['user_edit_avatar_control'] ?? null;
//
//        $curtime = time();
//        $userPhotoPath = public_path().'/images/user_photo/';
//        $avatarPath = public_path().'/images/avatars/';
//
//        $image = Image::make($file_name);
//
//        $image_name = $curtime.$file_name->getClientOriginalName();
//        $image->save($userPhotoPath.$image_name);
//        $image->resize(82, 82);
//        $image->save($avatarPath.$image_name);
//        $client = null;

        $file_name = ($validated['user_edit_avatar_control'] ?? null);

        if($file_name) {
            $curtime = time();
            $userPhotoPath = public_path().'/images/user_photo/';
            $avatarPath = public_path().'/images/avatars/';

            $image = Image::make($file_name);

            $image_name = $curtime.$file_name->getClientOriginalName();
            $image->save($userPhotoPath.$image_name);
            $image->resize(82, 82);
            $image->save($avatarPath.$image_name);
        }

        try {
            $validated['photo'] = (isset($image_name) ? $image_name : null);
            $client = Client::create($validated);
        }
        catch (\Exception $e) {
            \Session::flash('success_msg', 'Ajout effectué avec succès.');
            return \Redirect::route('clients.show', [$client]);
        }

        \Session::flash('success_msg', 'Ajout effectué avec succès.');
        return \Redirect::route('clients.show', [$client]);
    }

    public  function show(Client $client) 
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'clients-show'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        } 

        $heading = "Fiche ". $client->full_name;
        $avatar_path = 'images/avatars/';
        return view('pages.clients.client_profile',
                compact('client', 'heading', 'avatar_path'))
                ->with('subheading', $this->subheading);
    }

    public function edit(Client $client)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'clients-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        } 

        $heading = "Modifier un client";

        $liste_quartiers = [null => ''] + Quartier::pluck('nom_quartier', 'id')->all();
        $liste_canal_prospects = [null => ''] + CanalProspect::pluck('canal_prospect', 'id')->all();
        $liste_clients = [null => ''] + Client::get()->pluck('afficher_client', 'id')->all();
        $avatar_path = 'images/avatars/';

        return view(
            'pages.clients.client_form_edit',
            compact('client', 'heading', 'liste_quartiers', 'liste_canal_prospects', 'liste_clients','avatar_path'))
            ->with('subheading', $this->subheading);
    }

    public function update(Client $client,ClientRequest $request)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'clients-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        } 

        $validated = $request->validated();
        $file_name = ($validated['user_edit_avatar_control'] ?? null);

        if($file_name) {
            $curtime = time();
            $userPhotoPath = public_path().'/images/user_photo/';
            $avatarPath = public_path().'/images/avatars/';

            $image = Image::make($file_name);

            $image_name = $curtime.$file_name->getClientOriginalName();
            $image->save($userPhotoPath.$image_name);
            $image->resize(82, 82);
            $image->save($avatarPath.$image_name);
        }

        try {
            $validated['photo'] = (isset($image_name) ? $image_name : $client->photo);
            $client->update($validated);
        }
        catch (\Exception $e) {
            \Session::flash('success_msg', 'Modification effectuée avec succès.');
            return \Redirect::route('clients.show', [$client]);
        }

        \Session::flash('success_msg', 'Modification effectuée avec succès.');
        return \Redirect::route('clients.show', [$client]);
    }

    public function destroy(Request $request,Client $client)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'clients-destroy'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        } 

        try {
            $client->delete();
            if ($request->ajax())
                return \Response::make('Suppression effectuée avec succès.', 200);
            else
                \Session::flash('success_msg', 'Suppression effectuée avec succès.');
        }
        catch (QueryException $e) {
            if ($request->ajax())
                return \Response::make('Impossible de supprimer cet enregistrement. Celui-ci est utilisée ailleurs.
                    Veuillez d\'abord supprimer ces références.', 403);
            else
                \Session::flash('error_msg', 'Erreur lors de la suppression.');
        }

        return \Redirect::route('clients.index');
    }

}
