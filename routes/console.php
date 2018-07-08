<?php

use Illuminate\Foundation\Inspiring;

Artisan::command('accesstoken', function () {
    $client = DB::table('oauth_clients')->where('password_client', '1')->first();

    $response = (new GuzzleHttp\Client)->post(url('oauth/token'), [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => 'colbygatte@gmail.com',
            'password' => 'localpassword!88',
            'scope' => '',
        ]
    ]);

    $this->comment(json_decode((string) $response->getBody(), true)['access_token']);
});
