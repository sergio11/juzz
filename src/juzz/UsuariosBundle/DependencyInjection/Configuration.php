<?php

namespace juzz\UsuariosBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('juzz_usuarios');
        $rootNode->
            children()
                ->arrayNode('registration')
                    ->children()
                        ->booleanNode('required_user_activation')
                            ->defaultValue(true)
                        ->end()
                        ->booleanNode('auto_login_when_confirmed')
                            ->defaultValue(true)
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('resetting')
                    ->children()
                        ->integerNode('token_ttl')
                            ->min(86400)
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
