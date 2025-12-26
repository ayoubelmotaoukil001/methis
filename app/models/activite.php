<?php

require_once __DIR__ . '/../Core/BaseModel.php';

class Activite extends BaseModel
{
    private $nom;
    private $date_activite;
    private $projet_id;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'activites';
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setDateActivite($date)
    {
        $this->date_activite = $date;
    }

    public function setProjetId($projet_id)
    {
        $this->projet_id = $projet_id;
    }

    public function save()
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO activites (nom, date_activite, projet_id)
             VALUES (:nom, :date_activite, :projet_id)"
        );

        return $stmt->execute([
            'nom' => $this->nom,
            'date_activite' => $this->date_activite,
            'projet_id' => $this->projet_id
        ]);
    }

    public function update($id)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE activites 
             SET nom = :nom, date_activite = :date_activite
             WHERE id = :id"
        );

        return $stmt->execute([
            'nom' => $this->nom,
            'date_activite' => $this->date_activite,
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM activites WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }

    public function getByProjet($projet_id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM activites WHERE projet_id = :projet_id"
        );
        $stmt->execute(['projet_id' => $projet_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
