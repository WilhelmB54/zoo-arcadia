-- Création des tables
CREATE TABLE utilisateur (
    username VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL
);

CREATE TABLE role (
    role_id SERIAL PRIMARY KEY,
    label VARCHAR(255) NOT NULL
);

CREATE TABLE possede (
    username VARCHAR(255),
    role_id INT,
    PRIMARY KEY (username, role_id),
    FOREIGN KEY (username) REFERENCES utilisateur(username),
    FOREIGN KEY (role_id) REFERENCES role(role_id)
);

CREATE TABLE service (
    service_id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(500) NOT NULL
);

CREATE TABLE animal (
    animal_id SERIAL PRIMARY KEY,
    prenom VARCHAR(255) NOT NULL,
    etat VARCHAR(255) NOT NULL
);

CREATE TABLE rapport_veterinaire (
    rapport_veterinaire_id SERIAL PRIMARY KEY,
    date DATE NOT NULL,
    detail VARCHAR(255) NOT NULL
);

CREATE TABLE redige (
    username VARCHAR(255),
    rapport_veterinaire_id INT,
    PRIMARY KEY (username, rapport_veterinaire_id),
    FOREIGN KEY (username) REFERENCES utilisateur(username),
    FOREIGN KEY (rapport_veterinaire_id) REFERENCES rapport_veterinaire(rapport_veterinaire_id)
);

CREATE TABLE obtient (
    rapport_veterinaire_id INT,
    animal_id INT,
    PRIMARY KEY (rapport_veterinaire_id, animal_id),
    FOREIGN KEY (rapport_veterinaire_id) REFERENCES rapport_veterinaire(rapport_veterinaire_id),
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id)
);

CREATE TABLE habitat (
    habitat_id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(500) NOT NULL,
    commentaire_habitat VARCHAR(500)
);

CREATE TABLE detient (
    habitat_id INT,
    animal_id INT,
    PRIMARY KEY (habitat_id, animal_id),
    FOREIGN KEY (habitat_id) REFERENCES habitat(habitat_id),
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id)
);

CREATE TABLE race (
    race_id SERIAL PRIMARY KEY,
    label VARCHAR(255) NOT NULL
);

CREATE TABLE dispose (
    race_id INT,
    animal_id INT,
    PRIMARY KEY (race_id, animal_id),
    FOREIGN KEY (race_id) REFERENCES race(race_id),
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id)
);

CREATE TABLE image (
    image_id SERIAL PRIMARY KEY,
    image_data BYTEA
);

CREATE TABLE avis (
    avis_id SERIAL PRIMARY KEY,
    pseudo VARCHAR(255) NOT NULL,
    commentaire VARCHAR(255) NOT NULL,
    isVisible BOOLEAN
);

CREATE TABLE comporte (
    habitat_id INT,
    image_id INT,
    PRIMARY KEY (habitat_id, image_id),
    FOREIGN KEY (habitat_id) REFERENCES habitat(habitat_id),
    FOREIGN KEY (image_id) REFERENCES image(image_id)
);

CREATE TABLE nourriture (
    nourriture_id SERIAL PRIMARY KEY,
    label VARCHAR(255) NOT NULL
);

CREATE TABLE consommation (
    consommation_id SERIAL PRIMARY KEY,
    animal_id INT,
    nourriture_id INT,
    date DATE NOT NULL,
    heure TIME NOT NULL,
    quantite DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id),
    FOREIGN KEY (nourriture_id) REFERENCES nourriture(nourriture_id)
);

CREATE TABLE horaires (
    id SERIAL PRIMARY KEY,
    jour_semaine VARCHAR(20) NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL
);
