<?php

namespace App\EventSubscriber;

use App\Repository\ConferenceRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{

    private $twig;

    private $conference_repository;

    public function __construct(Environment $twig, ConferenceRepository $conference_repository)
    {
        $this->twig = $twig;
        $this->conference_repository = $conference_repository;
    }

    public function onControllerEvent(ControllerEvent $event)
    {
        // ...
        $this->twig->addGlobal('conferences', $this->conference_repository->findAll());
    }

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
