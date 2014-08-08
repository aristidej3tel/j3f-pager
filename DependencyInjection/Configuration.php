<?php

namespace J3tel\PagerBundle\DependencyInjection;

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
        $treeBuilder
            ->root('j3tel_pager')
                ->children()
                    ->arrayNode('default')
                        ->children()
                            //the number of pages that are displayed around the active page
                            ->integerNode('items_around_active_page')
                                ->min(0)
                                ->defaultValue(2)
                            ->end()
                            ->integerNode('items_per_page')
                                ->min(0)
                                ->defaultValue(25)
                            ->end()
                            ->integerNode('first_page')
                                ->min(0)
                                ->defaultValue(1)
                            ->end()
                            // the number of first and last pages to be displayed 
                            ->integerNode('block_item')
                                ->min(0)
                                ->defaultValue(3)
                            ->end()
                            ->scalarNode('class')
                                ->defaultValue('')
                            ->end()
                        ->end()
                    ->end()
                ->end()
        ;
        return $treeBuilder;
    }
}
