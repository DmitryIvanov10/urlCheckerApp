<?php
declare(strict_types=1);

namespace App\Domain;

/**
 * @codeCoverageIgnore
 */
class UrlCheck
{
    public const STATUS_NEW = 'NEW';
    public const STATUS_PROCESSING = 'PROCESSING';
    public const STATUS_DONE = 'DONE';
    public const STATUS_ERROR = 'ERROR';

    private int $id = 0;
    private string $url = '';
    private string $status = self::STATUS_NEW;
    private ?int $httpCode;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatusProcessing(): void
    {
        $this->status = self::STATUS_PROCESSING;
    }

    public function setStatusDone(): void
    {
        $this->status = self::STATUS_DONE;
    }

    public function setStatusError(): void
    {
        $this->status = self::STATUS_ERROR;
    }

    public function getHttpCode(): ?int
    {
        return $this->httpCode;
    }

    public function setHttpCode(int $httpCode): void
    {
        $this->httpCode = $httpCode;
    }
}
