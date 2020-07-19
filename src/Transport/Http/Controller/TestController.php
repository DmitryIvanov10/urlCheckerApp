<?php
declare(strict_types=1);

namespace App\Transport\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @codeCoverageIgnore
 */
class TestController extends AbstractController
{
    public function getPhpInfo()
    {
        echo phpinfo();
    }
}
