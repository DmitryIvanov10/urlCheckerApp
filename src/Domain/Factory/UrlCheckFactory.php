<?php
declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Exception\BadArgumentException;
use App\Domain\UrlCheck;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UrlCheckFactory
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @throws BadArgumentException
     */
    public function create(string $url): UrlCheck
    {
        $urlCheck = new UrlCheck($url);

        $errors = $this->validator->validate($urlCheck);

        if (count($errors) > 0) {
            throw new BadArgumentException((string) $errors);
        }

        return $urlCheck;
    }
}
