<?php
require_once __DIR__ . '/../app/Models/Projet.php';
require_once __DIR__ . '/../app/Models/ProjetCourt.php';
require_once __DIR__ . '/../app/Models/ProjetLong.php';
require_once __DIR__ . '/../app/Models/Membre.php';
require_once __DIR__ . '/../app/Models/Activite.php';

$running = 1; 

while ($running !=0) {
    echo "\n1. Membres\n";
    echo "2. Projets\n";
    echo "3. Activites\n";
    echo "4. Quitter\n";

    $main = readline("Choix: ");

    switch ($main) {

        case 1:
            echo "\n1. Ajouter membre\n";
            echo "2. Afficher membres\n";
            $c = readline("Choix: ");

            if ($c == 1) {
                $m = new Membre();
                $m->setname(readline("Nom: "));
                $m->setprename(readline("Prenom: "));
                $m->setEmail(readline("Email: "));
                $m->save();
                echo "Membre ajouté avec succès\n";
            }

            if ($c == 2) {
                $m = new Membre();
                $membres = $m->findAll();
                if ($membres) {
                    foreach ($membres as $mem) {
                        echo "[{$mem['id']}] {$mem['nom']} {$mem['prenom']} - {$mem['email']}\n";
                    }
                } else {
                    echo "Aucun membre trouvé.\n";
                }
            }
            break;

        case 2:
            echo "\n1. Projet court\n";
            echo "2. Projet long\n";
            echo "3. Supprimer projet\n";
            $c = readline("Choix: ");

            if ($c == 1 || $c == 2) {
                $p = $c == 1 ? new ProjetCourt() : new ProjetLong();
                $p->setTitre(readline("Titre: "));
                $p->setDescription(readline("Description: "));
                $p->setMembreId(readline("Membre ID: "));
                $p->save();
                echo "Projet ajouté avec succès\n";
            }

            if ($c == 3) {
                $id = readline("ID projet à supprimer: ");
                $pCourt = new ProjetCourt();
                $pLong = new ProjetLong();

              
                if ($pCourt->findById($id)) {
                    $pCourt->delete($id);
                    echo "Projet court supprimé\n";
                } elseif ($pLong->findById($id)) {
                    $pLong->delete($id);
                    echo "Projet long supprimé\n";
                } else {
                    echo "Projet introuvable\n";
                }
            }
            break;

        case 3:
            echo "\n1. Ajouter activite\n";
            echo "2. Modifier activite\n";
            echo "3. Supprimer activite\n";
            echo "4. Historique projet\n";
            $c = readline("Choix: ");

            if ($c == 1) {
                $a = new Activite();
                $a->setNom(readline("Nom: "));
                $a->setDateActivite(readline("Date YYYY-MM-DD: "));
                $a->setProjetId(readline("Projet ID: "));
                $a->save();
                echo "Activité ajoutée\n";
            }

            if ($c == 2) {
                $a = new Activite();
                $id = readline("ID activite: ");
                if ($a->findById($id)) {
                    $a->setNom(readline("Nom: "));
                    $a->setDateActivite(readline("Date YYYY-MM-DD: "));
                    $a->update($id);
                    echo "Activité modifiée\n";
                } else {
                    echo "Activité introuvable\n";
                }
            }

            if ($c == 3) {
                $a = new Activite();
                $id = readline("ID activite: ");
                if ($a->findById($id)) {
                    $a->delete($id);
                    echo "Activité supprimée\n";
                } else {
                    echo "Activité introuvable\n";
                }
            }

            if ($c == 4) {
                $a = new Activite();
                $id = readline("Projet ID: ");
                $activites = $a->getByProjet($id);
                if ($activites) {
                    foreach ($activites as $act) {
                        echo "[{$act['id']}] {$act['nom']} - {$act['date_activite']}\n";
                    }
                } else {
                    echo "Aucune activité pour ce projet.\n";
                }
            }
            break;

        case 4:
            echo "Au revoir!\n";
            $running = 0; 
            break;

        default:
            echo "Choix invalide\n";
    }
}
