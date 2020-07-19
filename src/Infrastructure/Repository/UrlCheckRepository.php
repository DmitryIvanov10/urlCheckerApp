<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Exception\NotFoundException;
use App\Domain\Interfaces\Repository\UrlCheckRepositoryInterface;
use App\Domain\UrlCheck;
use App\Infrastructure\Exception\InfrastructureException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;

/**
 * @codeCoverageIgnore
 */
class UrlCheckRepository extends ServiceEntityRepository implements UrlCheckRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UrlCheck::class);
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): UrlCheck
    {
        /** @var UrlCheck $urlCheck */
        $urlCheck = $this->find($id);

        if (null === $urlCheck) {
            throw new NotFoundException(UrlCheck::class, ['id' => $id]);
        }

        return $urlCheck;
    }

    /**
     * @inheritDoc
     */
    public function remove(UrlCheck $urlCheck): void
    {
        $em = $this->getEntityManager();

        try {
            $em->remove($urlCheck);
            $em->flush();
        } catch (ORMException $exception) {
            throw new InfrastructureException('Cannot remove Url Check', 0, $exception);
        }
    }

    /**
     * @inheritDoc
     */
    public function save(UrlCheck $urlCheck): UrlCheck
    {
        $em = $this->getEntityManager();

        try {
            $em->persist($urlCheck);
            $em->flush($urlCheck);
        } catch (ORMException $exception) {
            throw new InfrastructureException('Cannot create Url Check', 0, $exception);
        }

        return $urlCheck;
    }

    /**
     * @inheritDoc
     */
    public function findAllNew(): array
    {
        return $this->findBy(['status' => UrlCheck::STATUS_NEW]);
    }
}
