CREATE DATABASE gestion_notes CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE gestion_notes;

-- Table Classe
CREATE TABLE classe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idClasse VARCHAR(50) UNIQUE NOT NULL,
    libelleClasse VARCHAR(100) NOT NULL
);

-- Table Etudiant
CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriEt VARCHAR(50) UNIQUE NOT NULL,
    nom VARCHAR(100) NOT NULL,
    mail VARCHAR(100) UNIQUE NOT NULL,
    photo BLOB,
    idClasse INT,
    FOREIGN KEY (idClasse) REFERENCES classe(id) ON DELETE SET NULL
);

-- Table Matiere
CREATE TABLE matiere (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idMat VARCHAR(50) UNIQUE NOT NULL,
    libelleMat VARCHAR(100) NOT NULL
);

-- Table Composer (notes)
CREATE TABLE composer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    natureEval VARCHAR(50) NOT NULL,
    noteEval DOUBLE NOT NULL CHECK(noteEval BETWEEN 0 AND 20),
    anneeAc INT NOT NULL,
    idEtudiant INT,
    idMatiere INT,
    FOREIGN KEY (idEtudiant) REFERENCES etudiant(id) ON DELETE CASCADE,
    FOREIGN KEY (idMatiere) REFERENCES matiere(id) ON DELETE CASCADE
);

-- Table Utilisateur (login)
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','etudiant') NOT NULL,
    idEtudiant INT,
    FOREIGN KEY (idEtudiant) REFERENCES etudiant(id) ON DELETE SET NULL
);
