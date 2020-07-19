<?php
declare(strict_types=1);

namespace App\Services\Command;

use App\Domain\Exception\BadArgumentException;
use App\Domain\Exception\InfrastructureExceptionInterface;
use App\Domain\Factory\UrlCheckFactory;
use App\Infrastructure\Repository\UrlCheckRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore
 */
class CreateUrlCheckCommand extends Command
{
    private const URL_FIELD_NAME = 'url';

    protected static $defaultName = 'app:url-check:create';

    private UrlCheckRepository $urlCheckRepository;
    private UrlCheckFactory $urlCheckFactory;

    public function __construct(UrlCheckRepository $urlCheckRepository, UrlCheckFactory $urlCheckFactory)
    {
        parent::__construct();
        $this->urlCheckRepository = $urlCheckRepository;
        $this->urlCheckFactory = $urlCheckFactory;
    }

    protected function configure()
    {
        $this->addArgument(
            self::URL_FIELD_NAME,
            InputArgument::REQUIRED,
            'The code of the language.'
        );
    }

    /**
     * @throws InfrastructureExceptionInterface
     * @throws BadArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument(self::URL_FIELD_NAME);

        $output->writeln([
            'UrlCheck Creator',
            '================',
            '',
        ]);

        $urlCheck = $this->urlCheckFactory->create($url);
        $this->urlCheckRepository->save($urlCheck);

        $output->writeln([
            sprintf('UrlCheck for the URL %s successfully created', $url)
        ]);

        return 0;
    }
}
