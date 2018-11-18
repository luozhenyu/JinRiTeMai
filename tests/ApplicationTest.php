<?php

namespace Luozhenyu\Tests;


use Luozhenyu\JinRiTeMai\Application;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testStaticCall()
    {
        $app = Application::make('key', 'secret');

        $this->assertInstanceOf(\Luozhenyu\JinRiTeMai\Application::class, $app);

        $this->assertEquals('key', $app->getAppKey());
        $this->assertEquals('secret', $app->getAppSecret());
    }
}
