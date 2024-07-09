<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Laravel\Socialite\Two\AbstractProvider;

use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;


class SpbstuProvider extends AbstractProvider implements ProviderInterface
{
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://cas.spbstu.ru/oauth2.0/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://cas.spbstu.ru/oauth2.0/accessToken';
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessToken($code)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLINFO_HEADER_OUT => TRUE,
            CURLOPT_URL => $this->getTokenUrl(), //'https://cas.spbstu.ru/oauth2.0/accessToken',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'),
            CURLOPT_POSTFIELDS => 'client_id=' . env('SPBSTU_CLIENT_ID', null) . '&client_secret=' . env('SPBSTU_CLIENT_SECRET', null) . '&grant_type=authorization_code&code=' .
                $code . '&redirect_uri=' . env('SPBSTU_CALLBACK_URL', null) //'http://ido-test.spbstu.ru/auth/callback'
        ));


        $response = curl_exec($curl);

        return $this->parseAccessToken($response);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return \Arr::add(parent::getTokenFields($code), 'grant_type', 'authorization_code');
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://cas.spbstu.ru/oauth2.0/profile', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function formatScopes(array $scopes, $scopeSeparator)
    {
        return implode(' ', $scopes);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['wsAsu']['user_id'],
            'email' => $user['email'],
            'name' => $user['wsAsu']['last_name'] . ' ' . $user['wsAsu']['first_name'],
            'password' => ''
        ]);
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
