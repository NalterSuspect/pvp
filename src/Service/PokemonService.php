<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PokemonService
{
    private HttpClientInterface $httpClient;
    private RequestStack $requestStack;

    public function __construct(HttpClientInterface $httpClient, RequestStack $requestStack)
    {
        $this->httpClient = $httpClient;
        $this->requestStack = $requestStack;
    }
    function getAllPokemon(): void {
        $response = $this->httpClient->request('GET', 'https://tyradex.vercel.app/api/v1/pokemon');
        dd($response->toArray());
    }

    function getOnePokemon($id): void {
        $response = $this->httpClient->request('GET', 'https://tyradex.app/api/v1/pokemon/'.$id);
        dd($response->toArray());
    }

    function getAllPokemonTypes(): void {
        $response = $this->httpClient->request('GET', 'https://tyradex.app/api/v1/types');
        dd($response->toArray());
    }



}