<?php
require_once __DIR__ . '/../Core/BaseModel.php';
class Membre extends BaseModel {
    private $nom;
    private $prenom;
    private $email;

    public function __construct() {
        parent::__construct();
        $this->table = 'membres';
    }

    public function setname($nom) {
        $this->nom = $nom;
    }
    public function getname() {
        return $this->nom;
    }

    public function setprename($prenom) {
        $this->prenom = $prenom;
    }
    public function getprename() {
        return $this->prenom;
    }

    public function setemail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("email invalid");
        }
        $this->email = $email;
    }
    public function getemail() {
        return $this->email;
    }

    private function emailUni($email) {
        $stm = $this->pdo->prepare("SELECT COUNT(*) as count FROM {$this->table} WHERE email = :email");
        $stm->execute(['email' => $email]);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['count'] == 0;
    }

    public function save() {
        if (!$this->emailUni($this->email)) {
            throw new Exception("email deja etulise");
        }
        $stm = $this->pdo->prepare("INSERT INTO {$this->table} (nom, prenom, email) VALUES (:nom, :prenom, :email)");
        return $stm->execute([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email
        ]);
    }

    private function canDelete($id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM projets WHERE membre_id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] == 0;
    }

    public function delete($id) {
        if (!$this->canDelete($id)) {
            throw new Exception("Impossible de supprimer ce membre, il a des projets associés");
        }
        return parent::delete($id);
    }
}
?>
