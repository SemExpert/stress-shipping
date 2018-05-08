<?php

namespace Testing;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TokenHandler
{
    private $client;
    private $clientId;
    private $clienSecret;
    private $email;
    private $password;

    public function __construct($clientId, $clienSecret, $email, $password)
    {
        $this->client = new Client(['verify'=>false]);
        $this->clientId = $clientId;
        $this->clienSecret = $clienSecret;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @throws \Exception
     */
    public function getToken()
    {
        $params = [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clienSecret,
                'email'      => $this->email,
                'password'      => $this->password
            ]
        ];

        try {
            $response = $this->client->post(
                'https://dev-api.hopenvios.com.ar/api/v1/login',
                $params
            );
            $response = json_decode($response->getBody()->getContents(), true);

            return $response['access_token'];

        } catch (ClientException $e) {
            throw new \Exception($e->getResponse()->getBody()->getContents());
        }
    }
}

