<?php

namespace Vira\Hpropagate\Decorator;

use Symfony\Component\HttpClient\Response\AsyncResponse;
use Symfony\Component\HttpClient\AsyncDecoratorTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpClient implements HttpClientInterface
{
    use AsyncDecoratorTrait;

    public function __construct(
        private HttpClientInterface $client,
        private RequestStack $requestStack,
        private array $headersToPropagate,
    ) {}

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        if ($request = $this->requestStack->getMainRequest()) {
            $headersToPropagate = [
                'x-request-id',
                ...$this->headersToPropagate,
            ];

            foreach ($headersToPropagate as $header) {
                $options['headers'][$header] = $request->headers->get($header);
            }
        }

        return new AsyncResponse($this->client, $method, $url, $options);
    }
}
