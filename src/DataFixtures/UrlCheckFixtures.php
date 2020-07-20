<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Domain\Exception\BadArgumentException;
use App\Domain\Factory\UrlCheckFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @codeCoverageIgnore
 */
class UrlCheckFixtures extends Fixture
{
    private UrlCheckFactory $urlCheckFactory;

    public function __construct(UrlCheckFactory $urlCheckFactory)
    {
        $this->urlCheckFactory = $urlCheckFactory;
    }

    /**
     * @throws BadArgumentException
     */
    public function load(ObjectManager $manager)
    {
        $urls = [
            'https://proxify.io',
            'https://reddit.com',
        ];

        foreach ($urls as $url) {
            $manager->persist(
                $this->urlCheckFactory->create($url)
            );
        }

        $manager->flush();
    }
}
