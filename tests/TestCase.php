<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication
        , RefreshDatabase;

}
//php artisan test
//php artisan test --filter=AdvServiceTest
