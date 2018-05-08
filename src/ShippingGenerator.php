<?php

namespace Testing;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ShippingGenerator
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['verify'=>false]);
    }

    /**
     * @param $token
     * @return mixed
     * @throws \Exception
     */
    public function makeShipping($token, $seller)
    {
        $params = [
            "headers" => [
                "authorization" => "Bearer " . $token
            ],
            "form_params" => [
                "shipping_type" => "E",
                "seller_code"   => $seller,
                "storage_code"  => "BASE",
                "days_offset"   => "0",
                "pickup_point_id" => "ea87b800-3718-4a4b-9f4b-95a21fb82a90",
                "client" => [
                    "name" => "Micaela",
                    "email" => "micaela@semexpert.com.ar",
                    "id_type" => "D.N.I",
                    "id_number" => "37204226",
                    "telephone" => "11223344"
                ],
                "package" => [
                    "size_category" => "1",
                    "width" => "",
                    "length" => "",
                    "height" => "",
                    "value" => "10",
                    "weight" => "1"
                ],
               "sender" => [
                    "name" => "",
                    "id_number" => "",
                    "phone" => "",
                    "mail" => ""
               ]
            ]
        ];

        try {
            $response = $this->client->post('https://dev-api.hopenvios.com.ar/api/v1/shipping', $params);
            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            throw new \Exception($e->getResponse()->getBody()->getContents());
        }
    }
}