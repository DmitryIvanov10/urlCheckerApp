<?php
declare(strict_types=1);

namespace App\Transport\Amqp\Message;

/**
 * @codeCoverageIgnore
 */
class CheckUrl
{
    private int $urlCheckId;

    public function __construct(int $urlCheckId)
    {
        $this->urlCheckId = $urlCheckId;
    }

    public function getUrlCheckId(): int
    {
        return $this->urlCheckId;
    }
}
