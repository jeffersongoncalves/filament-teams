<?php

return [
    'navigation_group' => 'Utilisateur',
    'team' => [
        'label' => 'Équipe',
        'plural_label' => 'Équipes',
        'navigation_label' => 'Équipes',
    ],
    'invitation' => [
        'label' => 'Invitation d\'équipe',
        'plural_label' => 'Invitations d\'équipe',
        'navigation_label' => 'Invitations d\'équipe',
    ],
    'fields' => [
        'name' => 'Nom',
        'owner' => 'Propriétaire',
        'email' => 'Adresse e-mail',
        'team' => 'Équipe',
        'personal_team' => 'Équipe personnelle',
        'invitations' => 'Invitations',
        'created_at' => 'Créé le',
        'updated_at' => 'Mis à jour le',
    ],
    'tenancy' => [
        'register' => [
            'label' => 'Créer une équipe',
        ],
        'profile' => [
            'label' => 'Profil de l\'équipe',
        ],
    ],
    'invitations' => [
        'navigation_label' => 'Invitations',
        'title' => 'Invitations',
        'accept' => [
            'label' => 'Accepter',
            'heading' => 'Accepter l\'invitation ?',
            'success' => 'Invitation acceptée !',
        ],
        'cancel' => [
            'label' => 'Annuler',
            'heading' => 'Annuler l\'invitation ?',
            'success' => 'Invitation annulée !',
        ],
    ],
    'validation' => [
        'email_taken' => 'Cette adresse e-mail est déjà utilisée.',
    ],
];
