<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\formattersTests;

use PHPUnit\Framework\TestCase;
use vadimcontenthunter\MyLogger\formatters\BaseFormatter;

class BaseFormatterTest extends TestCase
{
    protected BaseFormatter $baseFormatter;

    public function setUp(): void
    {
        $this->baseFormatter = new BaseFormatter();
    }

    public function testOne()
    {
        $resultMessage = $this->baseFormatter->getMessage("my test", []);
        $this->assertEquals('', $resultMessage);
    }
}
