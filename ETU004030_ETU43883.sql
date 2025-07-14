use db_s2_ETU004030;
CREATE TABLE ExamS2_membre (
    id_membre  INT,
    nom VARCHAR(100),
    date_de_naissance DATE,
    genre CHAR(1),
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(100),
    image_profil VARCHAR(100)
);

CREATE TABLE ExamS2_categorie_objet (
    id_categorie INT,
    nom_categorie VARCHAR(100)
);

CREATE TABLE ExamS2_objet (
    id_objet  INT,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre  INT
);

CREATE TABLE ExamS2_images_objet (
    id_image  INT,
    id_objet  INT,
    nom_image VARCHAR(100)
);

CREATE TABLE ExamS2_emprunt (
    id_emprunt  INT,
    id_objet  INT,
    id_membre  INT,
    date_emprunt DATE,
    date_retour DATE
);

INSERT INTO ExamS2_membre (id_membre, nom, date_de_naissance, genre, email, ville, mdp, image_profil) VALUES
(1, 'Alice Dupont', '1990-05-15', 'F', 'alice.dupont@example.com', 'Paris', 'password123', 'alice.jpg'),
(2, 'Bob Martin', '1985-10-22', 'M', 'bob.martin@example.com', 'Lyon', 'password456', 'bob.jpg'),
(3, 'Charlie Petit', '2000-02-10', 'M', 'charlie.petit@example.com', 'Marseille', 'password789', 'charlie.jpg'),
(4, 'David Durand', '1995-07-30', 'M', 'david.durand@example.com', 'Nice', 'password321', 'david.jpg');

INSERT INTO ExamS2_categorie_objet (id_categorie, nom_categorie) VALUES
(1, 'esthétique'),
(2, 'bricolage'),
(3, 'mécanique'),
(4, 'cuisine');

INSERT ExamS2_objet (id_objet, nom_objet, id_categorie, id_membre ) VALUES
(1, 'brosse', 1, 1),
(2, 'marteau', 2, 1),
(3, 'moteur', 3, 1),
(4, 'marmitte', 4, 1),
(5, 'fer a lisser', 1, 1),
(6, 'clou', 2, 1),
(7, 'vice', 3, 1),
(8, 'gaz', 4, 1),
(9, 'maquillage', 1, 1),
(10, 'scie', 2, 1),
(11, 'brosse', 1, 2),
(12, 'marteau', 2, 2),
(13, 'moteur', 3, 2),
(14, 'marmitte', 4, 2),
(15, 'fer a lisser', 1, 2),
(16, 'clou', 2, 2),
(17, 'vice', 3, 2),
(18, 'gaz', 4, 2),
(19, 'maquillage', 1, 2),
(20, 'scie', 2, 2),
(21, 'brosse', 1, 3),
(22, 'marteau', 2, 3),
(23, 'moteur', 3, 3),
(24, 'marmitte', 4, 3),
(25, 'fer a lisser', 1, 3),
(26, 'clou', 2, 3),
(27, 'vice', 3, 3),
(28, 'gaz', 4, 3),
(29, 'maquillage', 1, 3),
(30, 'scie', 2, 3),
(31, 'brosse', 1, 4),
(32, 'marteau', 2, 4),
(33, 'moteur', 3, 4),
(34, 'marmitte', 4, 4),
(35, 'fer a lisser', 1, 4),
(36, 'clou', 2, 4),
(37, 'vice', 3, 4),
(38, 'gaz', 4, 4),
(39, 'maquillage', 1, 4),
(40, 'scie', 2, 4);

INSERT ExamS2_emprunt (id_emprunt, id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 1, 2, '2025-06-26', '2025-07-26'),
(2, 2, 3, '2025-06-26', '2025-07-26'),
(3, 12, 1, '2025-06-26', '2025-07-26'),
(4, 33, 4, '2025-06-26', '2025-07-26'),
(5, 14, 1, '2025-06-26', '2025-07-26'),
(6, 26, 2, '2025-06-26', '2025-07-26'),
(7, 11, 3, '2025-06-26', '2025-07-26'),
(8, 10, 4, '2025-06-26', '2025-07-26'),
(9, 40, 2, '2025-06-26', '2025-07-26'),
(10, 36, 1, '2025-06-26', '2025-07-26');
