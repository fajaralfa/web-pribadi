<?php

namespace Test;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function test_db()
    {
        $db = db();
        $this->assertInstanceOf(\PDO::class, $db);
    }
}
