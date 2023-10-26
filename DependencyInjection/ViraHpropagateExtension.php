<?php

declare(strict_types=1);

namespace Vira\Hpropagate\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Vira\Hpropagate\Decorator\HttpClient;

class ViraHpropagateExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $serviceDefinition = $container->getDefinition(HttpClient::class);
        $serviceDefinition->replaceArgument(2, $config['headers_to_propagate'] ?? []);
    }
}
