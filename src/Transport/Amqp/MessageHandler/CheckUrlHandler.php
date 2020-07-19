<?php
declare(strict_types=1);

namespace App\Transport\Amqp\MessageHandler;

use App\Domain\Exception\InfrastructureExceptionInterface;
use App\Domain\Exception\NotFoundException;
use App\Domain\Interfaces\Repository\UrlCheckRepositoryInterface;
use App\Transport\Amqp\Message\CheckUrl;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @codeCoverageIgnore
 */
class CheckUrlHandler implements MessageHandlerInterface
{
    private UrlCheckRepositoryInterface $urlCheckRepository;
    private HttpClientInterface $httpClient;

    public function __construct(UrlCheckRepositoryInterface $urlCheckRepository, HttpClientInterface $httpClient)
    {
        $this->urlCheckRepository = $urlCheckRepository;
        $this->httpClient = $httpClient;
    }

    /**
     * @throws InfrastructureExceptionInterface
     * @throws NotFoundException
     */
    public function __invoke(CheckUrl $checkUrl)
    {
        $urlCheck = $this->urlCheckRepository->get($checkUrl->getUrlCheckId());

        $urlCheck->setStatusProcessing();
        $this->urlCheckRepository->save($urlCheck);

        try {
            $response = $this->httpClient->request('GET', $urlCheck->getUrl());
            $urlCheck->setHttpCode($response->getStatusCode());
            $urlCheck->setStatusDone();
        } catch (TransportExceptionInterface $exception) {
            $urlCheck->setStatusError();
        }

        $this->urlCheckRepository->save($urlCheck);
    }
}
