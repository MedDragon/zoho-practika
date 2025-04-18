<?php

/**
 * Feature test for Deal API.
 *
 * @package Tests\Feature.
 * @subpackage Tests.
 * @author Artem.
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class DealApiTest
 *
 * @package Tests\Feature
 */
class DealApiTest extends TestCase
{
    /**
     * Тест отримання списку всіх угод.
     *
     * @title Отримати список угод
     * @group Угоди
     * @authenticated
     *
     * @return void
     */
    public function testItReturnsListOfDeals()
    {
        // При необхідності створення мок-даних через фабрики (якщо є модель Deal).
        // Deal::factory()->count(3)->create();
        $response = $this->getJson('/api/deals');

        $response->assertStatus(200);
    }
    //end testItReturnsListOfDeals()
} // end class
