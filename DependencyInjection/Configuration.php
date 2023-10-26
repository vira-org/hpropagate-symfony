<?php

declare(strict_types=1);

namespace Vira\Hpropagate\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('vira_hpropagate');
        /** @var ArrayNodeDefinition|NodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
            ->arrayNode('headers_to_propagate')
            ->info('List of headers to propagate in addition to x-request-id')
            ->end();

        return $treeBuilder;
    }
}
