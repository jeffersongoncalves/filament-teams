<?php

return [

    'navigation_group' => 'User',

    'team' => [
        'label' => 'Team',
        'plural_label' => 'Teams',
        'navigation_label' => 'Teams',
    ],

    'invitation' => [
        'label' => 'Team Invitation',
        'plural_label' => 'Team Invitations',
        'navigation_label' => 'Team Invitations',
    ],

    'fields' => [
        'name' => 'Name',
        'owner' => 'Owner',
        'email' => 'Email address',
        'team' => 'Team',
        'personal_team' => 'Personal team',
        'invitations' => 'Invitations',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
    ],

    'tenancy' => [
        'register' => [
            'label' => 'Register team',
        ],
        'profile' => [
            'label' => 'Team profile',
        ],
    ],

    'invitations' => [
        'navigation_label' => 'Invitations',
        'title' => 'Invitations',
        'accept' => [
            'label' => 'Accept',
            'heading' => 'Accept invitation?',
            'success' => 'Invitation accepted!',
        ],
        'cancel' => [
            'label' => 'Cancel',
            'heading' => 'Cancel invitation?',
            'success' => 'Invitation canceled!',
        ],
    ],

    'validation' => [
        'email_taken' => 'The email has already been taken.',
    ],

];
