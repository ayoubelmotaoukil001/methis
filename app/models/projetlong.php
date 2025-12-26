<?php
class projetlong extends Projet {
    public function getType() {
        return "long";
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