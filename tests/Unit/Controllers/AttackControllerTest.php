<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\Api\V1\AttacksController;
use App\Http\Requests\Attacks\AttackStoreRequest;
use App\Services\AttacksService;
use App\Models\Attack;
use App\Models\User;
use Illuminate\Http\Response;
use Mockery\MockInterface;
use Tests\TestCase;



class AttackControllerTest extends TestCase
{
    /**
     * @var AttackController
     */
    private $controller;

    /**
     * @var AttackService|MockInterface
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->mock(AttacksService::class);
        $this->controller = new AttacksController($this->service);
        
    }

    public function test_successful_attack()
    {
        $attacker_id = 1;
        $defender_id = 2;
        $attack_type_id = 3;

        $request = new AttackStoreRequest([
            'attack_type_id' => $attack_type_id,
            'attacker_id' => $attacker_id,
            'defender_id' => $defender_id,
        ]);

        $attacker_data = [
            'life' => 100,
            'points' => 50,
        ];

        $defender_data = [
            'life' => 100,
            'points' => 30,
        ];

        $latest_attack = ['id' => 1];

        $this->service->shouldReceive('generatePoints')
            ->with($attacker_id)
            ->andReturn($attacker_data);

        $this->service->shouldReceive('generatePoints')
            ->with($defender_id)
            ->andReturn($defender_data);

        $this->service->shouldReceive('latest_attack')
            ->with($attacker_id)
            ->andReturn($latest_attack);

        $this->service->shouldReceive('attackCreate')
            ->with($attack_type_id, $latest_attack, $attacker_data, $defender_data, $request)
            ->andReturn(new Response('', 201));

        $response = $this->controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());
    }

}
