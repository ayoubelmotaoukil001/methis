<?php
class ProjetCourt extends Projet {
    public function getType() {
        return "court";
    }

    public function save() {
        $stmt = $this->pdo->prepare(
            "INSERT INTO projets (titre, description, membre_id) VALUES (:titre, :description, :membre_id)"
        );

        return $stmt->execute([
            'titre' => $this->titre,
            'description' => $this->description,
            'membre_id' => $this->membre_id
        ]);
    }
}
?>
