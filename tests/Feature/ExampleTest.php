<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the application returns a successful response', function () {
    $this->withSession([
        'auth_id' => 1,
        'auth_role' => 'admin',
        'auth_name' => 'Admin Test',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
});

test('guest diarahkan ke login', function () {
    $this->get('/')->assertRedirect('/login');
});
