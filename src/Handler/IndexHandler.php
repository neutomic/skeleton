<?php

declare(strict_types=1);

namespace App\Handler;

use Neu\Component\DependencyInjection\Project;
use Neu\Component\Http\Message\Method;
use Neu\Component\Http\Message\RequestInterface;
use Neu\Component\Http\Message\ResponseInterface;
use Neu\Component\Http\Message\Response;
use Neu\Component\Http\Router\Route;
use Neu\Component\Http\Runtime\Context;
use Neu\Component\Http\Runtime\Handler\HandlerInterface;
use Twig\Environment;
use Twig\Error\Error as TwigError;

/**
 * The index handler used to render the index page.
 */
#[Route(name: 'index', pattern: '/', methods: [Method::Get])]
final class IndexHandler implements HandlerInterface
{
    /**
     * The project instance.
     */
    private Project $project;

    /**
     * The twig environment used to render templates.
     */
    private Environment $twig;

    /**
     * The server counter.
     */
    private int $serverCounter = 0;

    /**
     * Create a new instance of the handler.
     *
     * @param Project $project The project instance.
     * @param Environment $twig The twig environment used to render templates.
     */
    public function __construct(Project $project, Environment $twig)
    {
        $this->project = $project;
        $this->twig = $twig;
    }

    /**
     * Handle the incoming request.
     *
     * @throws TwigError If an error occurs while rendering the template.
     */
    public function handle(Context $context, RequestInterface $request): ResponseInterface
    {
        $serverCounter = ++$this->serverCounter;

        $session = $request->getSession();
        $counter = $session->update('counter', static function(?int $count): int {
            return (null !== $count) ? ($count + 1) : 1;
        });

        $content = $this->twig->render('index.html.twig', [
            'project' => $this->project,
            'context' => $context,
            'serverCounter' => $serverCounter,
            'counter' => $counter,
        ]);

        return Response\html($content);
    }
}