<?php

namespace SNFe;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use SNFe\Http\Client;


class ApiRequester
{
    /**
     * @var \NFeCloud\Http\Client
     */
    public $client;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    public $lastResponse;

    /**
     * @var array
     */
    public $lastOptions;

    /**
     * ApiRequester constructor.
     */
    public function __construct()
    {
        $this->client = new Client;
    }

    /**
     * @param string $method   HTTP Method.
     * @param string $endpoint Relative to API base path.
     * @param array  $options  Options for the request.
     *
     * @return mixed
     */
    public function request($method, $endpoint, array $options = [])
    {
        $this->lastOptions = $options;
        // var_dump($method, $endpoint, $options);
        try {
            $response = $this->client->request($method, $endpoint, $options);
        } catch (ClientException $e) {
            
            $response = $e->getResponse();
        }
        
        return $this->response($response);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return object
     */
    public function response(ResponseInterface $response)
    {
        $this->lastResponse = $response;

        $content = $response->getBody()->getContents();
        // var_dump($content);
        //$data = json_decode($content); // parse as object        
        $data = json_decode($content); // parse as object        
        if(property_exists ($data , "status" ) && $data->status=="fail"){            
            throw new \Exception($data->message);
        }        
        
        return $data;
    }

}
