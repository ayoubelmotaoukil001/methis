<?php
require_once __DIR__ . '/../core/basemodel.php';
require_once __DIR__ . '/../Database/Database.php';


abstract class Projet extends BaseModel
{
    protected $titre;
    protected $description;
    protected $membre_id;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'projets';
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setMembreId($membre_id)
    {
        $this->membre_id = $membre_id;
    }

    abstract public function getType();
}
