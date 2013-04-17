<?php

namespace GetResponse\ApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('get_response_api');

        $rootNode
            ->children()
            ->scalarNode('url')->defaultValue('http://api2.getresponse.com')->cannotBeEmpty()->end()
            ->scalarNode('source')->defaultValue('https://raw.github.com/GetResponse/DevZone/master/API/lib/jsonRPCClient.php')->cannotBeEmpty()->end()
            ->scalarNode('key')->cannotBeEmpty()->end()
            ->scalarNode('campaign')->cannotBeEmpty()->end()
        ;

        return $treeBuilder;
    }
}
