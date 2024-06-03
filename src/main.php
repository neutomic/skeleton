<?php

declare(strict_types=1);

namespace App;

use Neu;
use Neu\Component\DependencyInjection\ContainerBuilder;
use Neu\Component\DependencyInjection\Project;
use Psl\Env;
use Psl\SecureRandom;

require_once __DIR__ . '/../vendor/autoload.php';

(static function(): void {
    // Load the project secret from the environment.
    $secret = Env\get_var('PROJECT_SECRET');
    if (null === $secret) {
        // Generate a random secret if it's not set.
        $secret = SecureRandom\string(32);

        // Set the secret as an environment variable.
        Env\set_var('PROJECT_SECRET', $secret);
    }

    // Create a new project instance.
    $project = Project::create($secret, __DIR__ . '/../', __FILE__);

    // Create the container.
    $container = ContainerBuilder::create($project, [], [
        new Neu\Component\Configuration\DependencyInjection\ConfigurationExtension(),
        new Neu\Bridge\Monolog\DependencyInjection\MonologExtension(),
        new Neu\Framework\DependencyInjection\FrameworkExtension(),
        new Neu\Bridge\Twig\DependencyInjection\TwigExtension(),
    ])->build();

    // Retrieve the engine from the container.
    $engine = $container->getTyped(Neu\Framework\EngineInterface::class, Neu\Framework\EngineInterface::class);

    // Run the engine.
    $engine->run();
})();

