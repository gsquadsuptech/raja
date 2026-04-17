<?php

use App\Models\Permission;
use App\Models\Roles;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // desactiver la contrainte de foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('permissions')->truncate();

    	$permissions = [
            ['name' => 'Liste des utilisateurs', 'slug' => 'users-list', 'categorie' => 'Utilisateurs'],
            ['name' => 'Ajouter utilisateur', 'slug' => 'users-create', 'categorie' => 'Utilisateurs'],
            ['name' => 'Modifier un utilisateur', 'slug' => 'users-update', 'categorie' => 'Utilisateurs'],
            ['name' => 'Supprimer un utilisateur', 'slug' => 'users-destroy', 'categorie' => 'Utilisateurs'],

            ['name' => 'Liste des patients', 'slug' => 'patients-list', 'categorie' => 'Patients'],
            ['name' => 'Ajouter un patient', 'slug' => 'patients-create', 'categorie' => 'Patients'],
            ['name' => 'Modifier un patient', 'slug' => 'patients-update', 'categorie' => 'Patients'],
            ['name' => 'Supprimer un patient', 'slug' => 'patients-destroy', 'categorie' => 'Patients'],

            ['name' => 'Liste des consultations', 'slug' => 'consultations-list', 'categorie' => 'Consultations'],
            ['name' => 'Ajouter une consultation', 'slug' => 'consultations-create', 'categorie' => 'Consultations'],
            ['name' => 'Modifier une consultation', 'slug' => 'consultations-update', 'categorie' => 'Consultations'],
            ['name' => 'Supprimer une consultation', 'slug' => 'consultations-destroy', 'categorie' => 'Consultations'],

            ['name' => 'Liste des ordonnances', 'slug' => 'ordonnances-list', 'categorie' => 'Ordonnances'],
            ['name' => 'Ajouter une ordonnance', 'slug' => 'ordonnances-create', 'categorie' => 'Ordonnances'],
            ['name' => 'Modifier une ordonnance', 'slug' => 'ordonnances-update', 'categorie' => 'Ordonnances'],
            ['name' => 'Supprimer une ordonnance', 'slug' => 'ordonnances-destroy', 'categorie' => 'Ordonnances'],

            ['name' => 'Liste des examens', 'slug' => 'examens-list', 'categorie' => 'Examens'],
            ['name' => 'Ajouter une examen', 'slug' => 'examens-create', 'categorie' => 'Examens'],
            ['name' => 'Modifier une examen', 'slug' => 'examens-update', 'categorie' => 'Examens'],
            ['name' => 'Supprimer une examen', 'slug' => 'examens-destroy', 'categorie' => 'Examens'],

            ['name' => 'Liste des clients', 'slug' => 'clients-list', 'categorie' => 'Clients'],
            ['name' => 'Ajouter un client', 'slug' => 'clients-create', 'categorie' => 'Clients'],
            ['name' => 'Visualiser un client', 'slug' => 'clients-show', 'categorie' => 'Clients'],
            ['name' => 'Modifier un client', 'slug' => 'clients-update', 'categorie' => 'Clients'],
            ['name' => 'Supprimer un client', 'slug' => 'clients-destroy', 'categorie' => 'Clients'],

            ['name' => 'Liste des rôles', 'slug' => 'roles-list', 'categorie' => 'Rôles'],
            ['name' => 'Ajouter un rôle', 'slug' => 'roles-create', 'categorie' => 'Rôles'],
            ['name' => 'Modifier un rôle', 'slug' => 'roles-update', 'categorie' => 'Rôles'],
            ['name' => 'Supprimer un rôle', 'slug' => 'roles-destroy', 'categorie' => 'Rôles'],

            ['name' => 'Restaurer les paramètres', 'slug' => 'parametres-restaure', 'categorie' => 'Paramètrages'],
            ['name' => 'Modifier les paramètres', 'slug' => 'parametres-update', 'categorie' => 'Paramètrages'],
    	];

    	DB::table('permissions')->insert($permissions);

        // reactiver la contrainte de foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
