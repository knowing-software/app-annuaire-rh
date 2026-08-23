<?php
// Paramètres de connexion à la base de données de l'Annuaire RH.
// À adapter selon l'environnement de déploiement (hôte, base, utilisateur, mot de passe).
// Ne jamais utiliser le compte root MySQL/MariaDB ici : créez un utilisateur dédié à
// cette base, avec uniquement les droits nécessaires.

return [
    'host' => '127.0.0.1',
    'dbname' => 'annuaire_rh',
    'user' => 'CHANGE_ME',
    'password' => 'CHANGE_ME',
];
