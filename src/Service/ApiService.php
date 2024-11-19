<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ApiService
{
    private HttpClientInterface $httpClient;
    private RequestStack $requestStack;

    public function __construct(HttpClientInterface $httpClient, RequestStack $requestStack)
    {
        $this->httpClient = $httpClient;
        $this->requestStack = $requestStack;
    }
    function getAllPokemon(): array {
        $response = $this->httpClient->request('GET', 'https://tyradex.vercel.app/api/v1/pokemon');
        return $response->toArray();
    }

    function getOnePokemon($id): array {
        $response = $this->httpClient->request('GET', 'https://tyradex.app/api/v1/pokemon/'.$id);
        return $response->toArray();
    }

    function getAllPokemonTypes(): array {
        $response = $this->httpClient->request('GET', 'https://tyradex.app/api/v1/types');
        return $response->toArray();
    }



}