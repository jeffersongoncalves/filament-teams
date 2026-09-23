<?php

return [
    'navigation_group' => 'Usuario',
    'team' => [
        'label' => 'Equipo',
        'plural_label' => 'Equipos',
        'navigation_label' => 'Equipos',
    ],
    'invitation' => [
        'label' => 'Invitación de equipo',
        'plural_label' => 'Invitaciones de equipo',
        'navigation_label' => 'Invitaciones de equipo',
    ],
    'fields' => [
        'name' => 'Nombre',
        'owner' => 'Propietario',
        'email' => 'Correo electrónico',
        'team' => 'Equipo',
        'personal_team' => 'Equipo personal',
        'invitations' => 'Invitaciones',
        'created_at' => 'Creado el',
        'updated_at' => 'Actualizado el',
    ],
    'tenancy' => [
        'register' => [
            'label' => 'Registrar equipo',
        ],
        'profile' => [
            'label' => 'Perfil del equipo',
        ],
    ],
    'invitations' => [
        'navigation_label' => 'Invitaciones',
        'title' => 'Invitaciones',
        'accept' => [
            'label' => 'Aceptar',
            'heading' => '¿Aceptar invitación?',
            'success' => '¡Invitación aceptada!',
        ],
        'cancel' => [
            'label' => 'Cancelar',
            'heading' => '¿Cancelar invitación?',
            'success' => '¡Invitación cancelada!',
        ],
    ],
    'validation' => [
        'email_taken' => 'El correo electrónico ya está en uso.',
    ],
];
