<?php

return [
    'navigation_group' => 'ユーザー',
    'team' => [
        'label' => 'チーム',
        'plural_label' => 'チーム',
        'navigation_label' => 'チーム',
    ],
    'invitation' => [
        'label' => 'チーム招待',
        'plural_label' => 'チーム招待',
        'navigation_label' => 'チーム招待',
    ],
    'fields' => [
        'name' => '名前',
        'owner' => 'オーナー',
        'email' => 'メールアドレス',
        'team' => 'チーム',
        'personal_team' => '個人チーム',
        'invitations' => '招待',
        'created_at' => '作成日時',
        'updated_at' => '更新日時',
    ],
    'tenancy' => [
        'register' => [
            'label' => 'チームを登録',
        ],
        'profile' => [
            'label' => 'チームプロフィール',
        ],
    ],
    'invitations' => [
        'navigation_label' => '招待',
        'title' => '招待',
        'accept' => [
            'label' => '承認',
            'heading' => '招待を承認しますか？',
            'success' => '招待を承認しました！',
        ],
        'cancel' => [
            'label' => 'キャンセル',
            'heading' => '招待をキャンセルしますか？',
            'success' => '招待をキャンセルしました！',
        ],
    ],
    'validation' => [
        'email_taken' => 'このメールアドレスは既に使用されています。',
    ],
];
