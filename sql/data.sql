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
('Restauration', 'Profitez d''une expérience culinaire variée et de qualité lors de votre visite au Zoo Arcadia. Nos restaurants et kiosques dispersés à travers le parc vous offrent une sélection alléchante de plats savoureux, des options pour tous les goûts, des snacks rafraîchissants aux repas complets. Détendez-vous et rechargez vos batteries tout en savourant la vue sur nos magnifiques installations et en observant nos animaux dans un cadre naturel unique.'),
('Visite des habitats avec un guide (gratuit)', 'Explorez nos habitats fascinants accompagné par nos guides experts, et plongez-vous dans des environnements riches et diversifiés. De la savane africaine à la jungle luxuriante, en passant par les marais mystérieux, chaque visite est une occasion d''apprendre sur la faune et la flore locales. Nos guides vous offriront des informations enrichissantes sur nos espèces, leurs habitats et les efforts de conservation que nous entreprenons pour préserver ces écosystèmes précieux.'),
('Visite du zoo en petit train', 'Embarquez à bord de notre petit train pour une aventure panoramique à travers le Zoo Arcadia. Profitez d''une vue imprenable sur nos vastes installations et nos habitats diversifiés, tout en apprenant sur nos efforts de préservation et de conservation. Ce voyage relaxant est idéal pour les visiteurs de tous âges, offrant une perspective unique sur nos animaux et leurs environnements naturels.');

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
('Zoé123', 'Excellent zoo, j''ai adoré la diversité des animaux et l''ambiance paisible.', true),
('FamilleMartin', 'Un endroit formidable pour une journée en famille, les enfants étaient ravis !', true),
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

INSERT INTO nourriture (label) VALUES
('Viande'),
('Fruits'),
('Poisson'),
('Feuilles de bambou'),
('Insectes');

INSERT INTO consommation (animal_id, nourriture_id, date, heure, quantite) VALUES
(1, 1, '2024-07-10', '08:00:00', 5.5), -- Leo mange 5.5 kg de viande
(2, 1, '2024-07-10', '09:00:00', 4.0), -- Tigrou mange 4 kg de viande
(3, 2, '2024-07-10', '10:00:00', 1.5), -- Paco mange 1.5 kg de fruits
(4, 4, '2024-07-10', '11:00:00', 3.0), -- Bamboo mange 3 kg de feuilles de bambou
(5, 3, '2024-07-10', '12:00:00', 2.5), -- Croco mange 2.5 kg de poisson

(1, 1, '2024-07-11', '08:00:00', 6.0), -- Leo mange 6 kg de viande
(2, 1, '2024-07-11', '09:00:00', 4.2), -- Tigrou mange 4.2 kg de viande
(3, 2, '2024-07-11', '10:00:00', 1.8), -- Paco mange 1.8 kg de fruits
(4, 4, '2024-07-11', '11:00:00', 3.2), -- Bamboo mange 3.2 kg de feuilles de bambou
(5, 3, '2024-07-11', '12:00:00', 2.7); -- Croco mange 2.7 kg de poisson