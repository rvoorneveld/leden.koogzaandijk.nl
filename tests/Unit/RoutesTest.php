<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{

    protected const HTTP_STATUS_CODE_SUCCESS = 200;

    /**
     * It Returns Status Code Success On Homepage
     * @return void
     */
    public function testItReturnsStatusCodeSuccessOnHomepage(): void
    {
        $this->get('/')
            ->assertStatus(static::HTTP_STATUS_CODE_SUCCESS);
    }

    /**
     * It Returns Status Code Success On Members Create
     * @return void
     */
    public function testItReturnsStatusCodeSuccessOnMembersCreate(): void
    {
        $this->get('/members/create')
            ->assertStatus(static::HTTP_STATUS_CODE_SUCCESS);
    }

}
