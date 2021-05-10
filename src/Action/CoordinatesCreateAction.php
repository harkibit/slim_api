<?php

namespace App\Action;

use App\Domain\User\Service\CoordinatesAdd;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CoordinatesCreateAction
{
    private $userCreator;
    private $coo;

    public function __construct(CoordinatesAdd $coo)
    {
        $this->coo = $coo;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $coo = $this->coo->createUser($data);

        // Transform the result into the JSON representation
        $result = [
            'City ID' => $coo,
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}