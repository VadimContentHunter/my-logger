<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\formattersTests;

use vadimcontenthunter\MyLogger\formatters\BaseFormatter;
use vadimcontenthunter\MyLogger\Tests\src\BaseTestsFormatters;

class BaseFormatterTest extends BaseTestsFormatters
{
    public function setUp(): void
    {
        $this->baseFormatter = new BaseFormatter();
    }
}
