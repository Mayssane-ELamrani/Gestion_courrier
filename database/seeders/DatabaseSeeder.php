<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        if (!DB::table('personnes')->where('email', 'aya@gmail.com')->exists()) {
            DB::table('personnes')->insert([
                'nom_complet' => 'Aya',
                'email' => 'aya@gmail.com',
                'matricule' => 10011,
                'role' => 'user',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if (!DB::table('personnes')->where('email', 'mayssane@gmail.com')->exists()) {
            DB::table('personnes')->insert([
                'nom_complet' => 'Mayssane',
                'email' => 'mayssane@gmail.com',
                'matricule' => 10022,
                'role' => 'admin',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        
        $etats = [
            ['nom' => 'normal', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'urgent', 'created_at' => now(), 'updated_at' => now()],
        ];
        foreach ($etats as $etat) {
            if (!DB::table('etats')->where('nom', $etat['nom'])->exists()) {
                DB::table('etats')->insert($etat);
            }
        }

        
        $objets = [
            ['nom' => 'reclamation', 'description' => 'Réclamation', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'demande', 'description' => 'Demande', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'autre', 'description' => 'Autre', 'created_at' => now(), 'updated_at' => now()],
        ];
        foreach ($objets as $objet) {
            if (!DB::table('objets')->where('nom', $objet['nom'])->exists()) {
                DB::table('objets')->insert($objet);
            }
        }

       
        $departements = [
            ['nom' => 'Département Système dInformation CMSS', 'responsable' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Département Contrôle et Reporting', 'responsable' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Département Prestations et Assistance', 'responsable' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Département Liquidation des Prestations', 'responsable' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Département Comptabilité', 'responsable' => null, 'created_at' => now(), 'updated_at' => now()],
        ];
        foreach ($departements as $departement) {
            if (!DB::table('departements')->where('nom', $departement['nom'])->exists()) {
                DB::table('departements')->insert($departement);
            }
        }

       
        $reponses = [
            ['choix' => 'oui', 'created_at' => now(), 'updated_at' => now()],
            ['choix' => 'non', 'created_at' => now(), 'updated_at' => now()],
            ['choix' => 'au cour', 'created_at' => now(), 'updated_at' => now()],
        ];
        foreach ($reponses as $reponse) {
            if (!DB::table('reponses')->where('choix', $reponse['choix'])->exists()) {
                DB::table('reponses')->insert($reponse);
            }
        }
    }
}
