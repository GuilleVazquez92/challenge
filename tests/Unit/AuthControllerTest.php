<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    public function testLoginSuccess()
    {
        // Crea una instancia de AuthService falso
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Configura el método login para devolver un token
        $authService->expects($this->once())
            ->method('login')
            ->willReturn('my_token');

        // Crea una instancia de AuthController con AuthService falso
        $controller = new AuthController($authService);

        // Crea una solicitud de prueba con credenciales válidas
        $request = new LoginRequest(['email' => 'test@example.com', 'password' => 'password']);

        // Envía la solicitud al método de inicio de sesión
        $response = $controller->login($request);

        // Comprueba que la respuesta sea un JSON con el token y un código de estado 200
        $this->assertJsonStringEqualsJsonString('{"token": "my_token"}', $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
    }
    public function testLoginFailure()
    {
        // Crea una instancia de AuthService falso
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Configura el método login para devolver nulo
        $authService->expects($this->once())
            ->method('login')
            ->willReturn(null);

        // Crea una instancia de AuthController con AuthService falso
        $controller = new AuthController($authService);

        // Crea una solicitud de prueba con credenciales inválidas
        $request = new LoginRequest(['email' => 'test@example.com', 'password' => 'wrong_password']);

        // Envía la solicitud al método de inicio de sesión
        $response = $controller->login($request);

        // Comprueba que la respuesta sea un JSON con un mensaje de error y un código de estado 401
        $this->assertJsonStringEqualsJsonString('{"message": "Incorrect Credentials"}', $response->getContent());
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testRegisterSuccess()
    {
        // Crea una instancia de AuthService falso
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Configura el método register para devolver un token
        $authService->expects($this->once())
            ->method('register')
            ->willReturn('my_token');

        // Crea una instancia de AuthController con AuthService falso
        $controller = new AuthController($authService);

        // Crea una solicitud de prueba con datos válidos
        $request = new RegisterRequest(['name' => 'Test User', 'email' => 'test@example.com', 'password' => 'password']);

        // Envía la solicitud al método de registro
        $response = $controller->register($request);

        // Comprueba que la respuesta sea un JSON con el token y un código de estado 201
        $this->assertJsonStringEqualsJsonString('{"token": "my_token"}', $response->getContent());
        $this->assertEquals(201, $response->getStatusCode());
    }
}
