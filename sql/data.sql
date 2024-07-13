-- Insérer les utilisateurs avec des mots de passe hashés
INSERT INTO utilisateur (username, password, nom, prenom) VALUES
('admin@zooarcadia.com', '$2y$10$vm9qXe5/NjQ5KiU7BZbjc.dEW05zSWz.nzqXHycrAULmvztqwRksW', 'Martin', 'Alexandre'),
('veterinaire@zooarcadia.com', '$2y$10$xDTJa6dgGIPknagkdzHi.OmKEfQYqg6ZUneDJXYMavExMOqvuoNXK', 'Dubois', 'Sophie'),
('employe@zooarcadia.com', '$2y$10$8hfV4YcR0QogNJBFzh6UrOOcrLLL5JKNVYaqI3ljPOo9GR4/RzCt2', 'Dupont', 'Jean');

-- Insérer les rôles
INSERT INTO role (label) VALUES
('admin'),
('veterinaire'),
('employe');

-- Insérer les relations utilisateurs et rôles
INSERT INTO possede (username, role_id) VALUES
('admin@zooarcadia.com', 1),
('veterinaire@zooarcadia.com', 2),
('employe@zooarcadia.com', 3);

-- Insérer les services
INSERT INTO service (nom, description) VALUES
('Restauration', 'Profitez d''une expérience culinaire variée et de qualité lors de votre visite au Zoo Arcadia.'),
('Visite des habitats avec un guide', 'Explorez nos habitats fascinants accompagné par nos guides experts.'),
('Visite du zoo en petit train', 'Embarquez à bord de notre petit train pour une aventure panoramique à travers le Zoo Arcadia.');

-- Insérer les habitats
INSERT INTO habitat (nom, description, commentaire_habitat) VALUES
('Savane', 'La savane du Zoo Arcadia représente un écosystème vaste et diversifié.', 'L''habitat de la savane semble bien adapté aux besoins de nos animaux africains. Cependant, je recommande de vérifier régulièrement l''état des points d''eau pour assurer un approvisionnement adéquat pendant les périodes sèches.'),
('Jungle', 'Notre jungle est un éden tropical où la biodiversité foisonne parmi les frondaisons luxuriantes et les murmures des cours d''eau.', ' La végétation dense de la jungle offre un bon abri naturel pour nos animaux tropicaux. Pour améliorer leur bien-être, je propose d''enrichir les zones d''escalade et d''introduire plus d''éléments naturels pour encourager l''exploration et l''activité physique.'),
('Marais', 'Le marais du Zoo Arcadia est un refuge tranquille pour une diversité remarquable d''animaux aquatiques.', 'Le marais offre un habitat diversifié pour nos espèces aquatiques. Pour améliorer leur confort, je recommande de vérifier régulièrement la qualité de l''eau et d''optimiser les zones d''alimentation pour soutenir leur nutrition et leur comportement naturel.');

-- Insérer les animaux
INSERT INTO animal (prenom, etat) VALUES
('Leo', 'Bon'),
('Tigrou', 'Bon'),
('Paco', 'Bon'),
('Bamboo', 'Bon'),
('Croco', 'Bon');

-- Insérer les rapports vétérinaires
INSERT INTO rapport_veterinaire (date, detail) VALUES
('2024-06-25', 'Leo, le lion, est en pleine forme. Il dévore !'),
('2024-06-22', 'Tigrou, le tigre, est en bonne santé. Il aime courir vite.'),
('2024-06-20', 'Paco, le perroquet, est très actif. Il parle tout le temps.'),
('2024-06-24', 'Bamboo, le panda, est en pleine forme. Il aime se la couler douce.'),
('2024-06-23', 'Croco, le crocodile, à une faim de loup. Il croque !');

-- Insérer les races
INSERT INTO race (label) VALUES
('Lion'),
('Tigre'),
('Perroquet'),
('Panda'),
('Crocodile');

-- Insérer les avis
INSERT INTO avis (pseudo, commentaire, isVisible) VALUES 
('Zoé123', 'Excellent zoo, j''ai adoré la diversité des animaux et l''ambiance paisible.', true);
('FamilleMartin', 'Un endroit formidable pour une journée en famille, les enfants étaient ravis !', true);
('NatureLover99', 'Les habitats sont bien conçus, on se sent vraiment immergé dans la nature.', true);

-- Insérer les relations animaux et races
INSERT INTO dispose (animal_id, race_id) VALUES
(1, 1), -- Leo est un Lion
(2, 2), -- Tigrou est un Tigre
(3, 3), -- Paco est un Perroquet
(4, 4), -- Bamboo est un Panda
(5, 5); -- Croco est un Crocodile

-- Insérer les relations animaux et rapports vétérinaires
INSERT INTO obtient (animal_id, rapport_veterinaire_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- Insérer les relations habitats et animaux
INSERT INTO detient (habitat_id, animal_id) VALUES
(1, 1), -- Leo dans la Savane
(1, 2), -- Tigrou dans la Savane
(2, 3), -- Paco dans la Jungle
(2, 4), -- Bamboo dans la Jungle
(3, 5); -- Croco dans le Marais