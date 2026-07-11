<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Seed roles and permissions to ensure they exist for all tests
        $this->seed(RoleSeeder::class);
        $this->seed(PermissionSeeder::class);
    }
}
