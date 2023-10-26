<?php

declare(strict_types=1);

namespace Vira\Hpropagate;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Vira\Hpropagate\DependencyInjection\ViraHpropagateExtension;

class ViraHpropagateBundle extends Bundle
{
    public function getContainerExtension(): Extension
    {
        if (null === $this->extension) {
            $this->extension = new ViraHpropagateExtension();
        }

        return $this->extension;
    }
}