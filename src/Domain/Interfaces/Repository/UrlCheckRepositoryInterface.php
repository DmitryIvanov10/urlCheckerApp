<?php
declare(strict_types=1);

namespace App\Domain\Interfaces\Repository;

use App\Domain\Exception\InfrastructureExceptionInterface;
use App\Domain\Exception\NotFoundException;
use App\Domain\UrlCheck;

interface UrlCheckRepositoryInterface
{
    /**
     * @throws NotFoundException
     */
    public function get(int $id): UrlCheck;

    /**
     * @throws InfrastructureExceptionInterface
     */
    public function remove(UrlCheck $urlCheck): void;

    /**
     * @throws InfrastructureExceptionInterface
     */
    public function save(UrlCheck $urlCheck): UrlCheck;

    /**
     * @return UrlCheck[]
     */
    public function findAllNew(): array;
}
