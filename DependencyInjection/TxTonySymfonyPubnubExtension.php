<?php

namespace TxTony\SymfonyPubnub\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class TxTonySymfonyPubnubExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $config = $this->processConfiguration(new Configuration(), $config);

        $definition = $container->getDefinition('txtony.pubnub.client.pubnub');
        $definition->replaceArgument(0, $config);
    }
}
