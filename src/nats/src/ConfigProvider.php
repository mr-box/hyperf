<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace Hyperf\Nats;

use Hyperf\Nats\Driver\DriverFactory;
use Hyperf\Nats\Driver\DriverInterface;
use Psr\Container\ContainerInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                DriverInterface::class => function (ContainerInterface $container) {
                    $factory = $container->get(DriverFactory::class);
                    return $factory->get('default');
                },
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for amqp.',
                    'source' => __DIR__ . '/../publish/nats.php',
                    'destination' => BASE_PATH . '/config/autoload/nats.php',
                ],
            ],
        ];
    }
}
