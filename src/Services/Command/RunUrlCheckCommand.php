<?php
declare(strict_types=1);

namespace App\Services\Command;

use App\Infrastructure\Repository\UrlCheckRepository;
use App\Transport\Amqp\Message\CheckUrl;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @codeCoverageIgnore
 */
class RunUrlCheckCommand extends Command
{
    protected static $defaultName = 'app:url-check:run';

    private UrlCheckRepository $urlCheckRepository;
    private MessageBusInterface $messageBus;

    public function __construct(UrlCheckRepository $urlCheckRepository, MessageBusInterface $messageBus)
    {
        parent::__construct();
        $this->urlCheckRepository = $urlCheckRepository;
        $this->messageBus = $messageBus;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Running URL check',
            '=================',
            '',
        ]);

        foreach ($this->urlCheckRepository->findAllNew() as $urlCheck) {
            $this->messageBus->dispatch(new CheckUrl($urlCheck->getId()));
        }

        $output->writeln([
            'URLs checks are sent to the queue'
        ]);

        return 0;
    }
}
