<?php

use PHPUnit\Framework\TestCase;

class MainTests extends TestCase
{
    private $baseUrl = 'http://localhost:8083';

    public function testPageLoads()
    {
        $response = @file_get_contents($this->baseUrl);
        if ($response === false) {
            $this->markTestSkipped("Server not reachable at {$this->baseUrl}");
        }
        $this->assertStringContainsString('<h1>R6.06 Maintenance applicative</h1>', $response);
    }
}
