<?php
namespace MonthlyBasis\ContentModerationTest;

use MonthlyBasis\ContentModeration\Module;
use MonthlyBasis\LaminasTest\ModuleTestCase;

class ModuleTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        $this->module = new Module();
    }
}
