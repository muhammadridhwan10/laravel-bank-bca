<?php

namespace Ridhwan\LaravelBankBca\Services;

use Ridhwan\LaravelBankBca\Bca;

class Authentication extends Bca
{
    /**
     * AccessToken
     *
     * @return \Ridhwan\Response\Response
     */
    public function AccessToken()
    {
        $requestUrl = '/api/oauth/token';
        return $this->sendRequest('POST', $requestUrl, [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);
    }
}
