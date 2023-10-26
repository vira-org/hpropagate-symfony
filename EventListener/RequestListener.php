<?php

namespace Vira\Hpropagate\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Uid\Uuid;

class RequestListener
{
    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (!$request) {
            return;
        }

        $requestId = $request->headers->get('x-request-id');

        if (!$requestId) {
            $requestId = Uuid::v4();
            $event->getRequest()->headers->set('x-request-id', $requestId);
        }
    }
}