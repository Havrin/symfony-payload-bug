<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final readonly class ExceptionResponseEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'handleResponseType',
        ];
    }

    public function handleResponseType(ExceptionEvent $event): void
    {
        if ($event->getRequest()->headers->get(key: 'Content-Type') !== 'application/json') {
            return;
        }

        $throwable = $event->getThrowable();
        if ($throwable instanceof HttpException && $throwable->getStatusCode() === Response::HTTP_UNPROCESSABLE_ENTITY) {
            $previousException = $event->getThrowable()->getPrevious();

            if (($previousException instanceof ValidationFailedException) && $previousException->getViolations()->count() > 0) {
                var_dump($previousException->getValue());

                return;
            }
        }
    }
}
