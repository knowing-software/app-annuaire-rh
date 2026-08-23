-- Schéma de la base de données de l'Annuaire RH Meridia
-- À importer dans une base dédiée à l'application (pas dans une base existante).

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS employes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    service_id INT,
    date_embauche DATE,
    FOREIGN KEY (service_id) REFERENCES services(id)
);

INSERT INTO services (nom) VALUES
    ('Direction'),
    ('Ressources Humaines'),
    ('Comptabilité'),
    ('Technique');

INSERT INTO employes (nom, prenom, email, service_id, date_embauche) VALUES
    ('Belhadj', 'Karim',  'k.belhadj@meridia.local', 1, '2015-03-01'),
    ('Ferrand', 'Nadia',  'n.ferrand@meridia.local', 2, '2018-06-15'),
    ('Roque',   'Julien', 'j.roque@meridia.local',   3, '2020-01-10'),
    ('Amaro',   'Sophie', 's.amaro@meridia.local',   4, '2021-09-01');
