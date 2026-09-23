<?php

return [
    'navigation_group' => 'Utente',
    'team' => [
        'label' => 'Team',
        'plural_label' => 'Team',
        'navigation_label' => 'Team',
    ],
    'invitation' => [
        'label' => 'Invito al team',
        'plural_label' => 'Inviti al team',
        'navigation_label' => 'Inviti al team',
    ],
    'fields' => [
        'name' => 'Nome',
        'owner' => 'Proprietario',
        'email' => 'Indirizzo email',
        'team' => 'Team',
        'personal_team' => 'Team personale',
        'invitations' => 'Inviti',
        'created_at' => 'Creato il',
        'updated_at' => 'Aggiornato il',
    ],
    'tenancy' => [
        'register' => [
            'label' => 'Registra team',
        ],
        'profile' => [
            'label' => 'Profilo del team',
        ],
    ],
    'invitations' => [
        'navigation_label' => 'Inviti',
        'title' => 'Inviti',
        'accept' => [
            'label' => 'Accetta',
            'heading' => 'Accettare l\'invito?',
            'success' => 'Invito accettato!',
        ],
        'cancel' => [
            'label' => 'Annulla',
            'heading' => 'Annullare l\'invito?',
            'success' => 'Invito annullato!',
        ],
    ],
    'validation' => [
        'email_taken' => 'L\'indirizzo email è già in uso.',
    ],
];
