<?php

return [
    'navigation_group' => 'Пользователь',
    'team' => [
        'label' => 'Команда',
        'plural_label' => 'Команды',
        'navigation_label' => 'Команды',
    ],
    'invitation' => [
        'label' => 'Приглашение в команду',
        'plural_label' => 'Приглашения в команду',
        'navigation_label' => 'Приглашения в команду',
    ],
    'fields' => [
        'name' => 'Название',
        'owner' => 'Владелец',
        'email' => 'Адрес эл. почты',
        'team' => 'Команда',
        'personal_team' => 'Личная команда',
        'invitations' => 'Приглашения',
        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
    ],
    'tenancy' => [
        'register' => [
            'label' => 'Зарегистрировать команду',
        ],
        'profile' => [
            'label' => 'Профиль команды',
        ],
    ],
    'invitations' => [
        'navigation_label' => 'Приглашения',
        'title' => 'Приглашения',
        'accept' => [
            'label' => 'Принять',
            'heading' => 'Принять приглашение?',
            'success' => 'Приглашение принято!',
        ],
        'cancel' => [
            'label' => 'Отменить',
            'heading' => 'Отменить приглашение?',
            'success' => 'Приглашение отменено!',
        ],
    ],
    'validation' => [
        'email_taken' => 'Этот адрес эл. почты уже занят.',
    ],
];
