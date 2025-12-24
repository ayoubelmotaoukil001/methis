CREATE DATABASE metis;
USE metis;

CREATE TABLE membres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL
);

CREATE TABLE projets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    description TEXT,
    membre_id INT NOT NULL,
    FOREIGN KEY (membre_id) REFERENCES membres(id) ON DELETE CASCADE
);

CREATE TABLE activites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    date_activite DATE NOT NULL,
    projet_id INT NOT NULL,
    FOREIGN KEY (projet_id) REFERENCES projets(id) ON DELETE CASCADE
);
