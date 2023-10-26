<?php

namespace Vira\Hpropagate\Logger;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestProcessor implements ProcessorInterface
{
    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    // this method is called for each log record; optimize it to not hurt performance
    public function __invoke(LogRecord $record): LogRecord
    {
        $request = $this->requestStack->getMainRequest();

        $record->extra['req']['id'] = $request->headers->get('x-request-id');

        return $record;
    }
}