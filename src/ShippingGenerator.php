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
     * @param $seller
     * @param $pde
     * @return mixed
     * @throws \Exception
     */
    public function makeShipping($token, $seller, $pde)
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
                "pickup_point_id" => $pde,
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

        $getPDEParams = [
            "headers" => [
                "authorization" => "Bearer " . $token
            ]
        ];

        $estimateParams = [
            "headers" => [
                "authorization" => "Bearer " . $token
            ],
            'query' => [
                'origin_zipcode'=>1778,
                'destiny_zipcode'=>1778,
                'shipping_type'=>"E",
                'package' => [
                    'size_category' => 1,
                    'value'=>1
                ],
                'seller_code'=>"BONVIVIR"
            ]
        ];

        try {
            $pdes = $this->client->get('https://dev-api.hopenvios.com.ar/api/v1/pickup_points', $getPDEParams);
            $estimate = $this->client->get('https://dev-api.hopenvios.com.ar/api/v1/pricing/estimate',$estimateParams);
            error_log(
                json_decode($pdes->getBody()->getContents(), true),
                3,
                '/home/diego/code/stress-shipping/public/error.log'
            );
            error_log(
                json_decode($estimate->getBody()->getContents(), true),
                3,
                '/home/diego/code/stress-shipping/public/error.log'
            );
            $response = $this->client->post('https://dev-api.hopenvios.com.ar/api/v1/shipping', $params);
            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            throw new \Exception($e->getResponse()->getBody()->getContents());
        }
    }
}