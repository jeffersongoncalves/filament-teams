<?php

return [

    'navigation_group' => 'Usuário',

    'team' => [
        'label' => 'Time',
        'plural_label' => 'Times',
        'navigation_label' => 'Times',
    ],

    'invitation' => [
        'label' => 'Convite de Time',
        'plural_label' => 'Convites de Time',
        'navigation_label' => 'Convites de Time',
    ],

    'fields' => [
        'name' => 'Nome',
        'owner' => 'Proprietário',
        'email' => 'Endereço de e-mail',
        'team' => 'Time',
        'personal_team' => 'Time pessoal',
        'invitations' => 'Convites',
        'created_at' => 'Criado em',
        'updated_at' => 'Atualizado em',
    ],

    'tenancy' => [
        'register' => [
            'label' => 'Registrar time',
        ],
        'profile' => [
            'label' => 'Perfil do time',
        ],
    ],

    'invitations' => [
        'navigation_label' => 'Convites',
        'title' => 'Convites',
        'accept' => [
            'label' => 'Aceitar',
            'heading' => 'Aceitar convite?',
            'success' => 'Convite aceito!',
        ],
        'cancel' => [
            'label' => 'Cancelar',
            'heading' => 'Cancelar convite?',
            'success' => 'Convite cancelado!',
        ],
    ],

    'validation' => [
        'email_taken' => 'Este e-mail já foi utilizado.',
    ],

];
