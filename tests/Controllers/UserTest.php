<?php

namespace Tests\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testShouldReturnListUsers()
    {
        $currentUser = User::dontShowAdmin()->get();
        User::factory(3)->create();
        Auth::setUser(User::take(1)->first());
        $response = $this->get('users/list');
        $content = json_decode($response->getContent(), true);

        $response->assertOk();
        $this->assertEquals(count($content['list']), $currentUser->count() + 3);
    }

    public function testShouldCreateUser()
    {
        $totalCurrentUser = User::get()->count();
        Auth::setUser(User::take(1)->first());
        $values = [
            'email' => 'user@test.com',
            'name' => 'user test',
            'password' => 'userTest',
        ];
        $response = $this->post('users/store', $values);
        $response->assertOk();
        $content = json_decode($response->getContent(), true);
        $this->assertEquals("Usuário com sucesso!", $content['message']);
        $this->assertEquals($totalCurrentUser + 1, User::get()->count());
    }

    /**
     * @dataProvider fieldsAndValuesValidatorCreateUser
     */
    public function testShouldReturnErroesByValidator(array $values, array $expectedException)
    {
        Auth::setUser(User::take(1)->first());
        $response = $this->post('users/store', $values);
        $content = $response->exception->validator;
        $messages = $content->getMessageBag();
        $this->assertEquals($messages->getMessages(), $expectedException);
    }

    public function testShouldDeleteUser()
    {
        Auth::setUser(User::take(1)->first());
        $newUser = User::factory()->create();
        $this->delete("users/$newUser->id");
        $user = User::find($newUser->id);
        $this->assertEmpty($user);
    }

    public function fieldsAndValuesValidatorCreateUser()
    {
        return [
            'all_fields_required' => [
                'values' => [],
                'expectedException' => [
                    'name' => [ 'The name field is required.' ],
                    'email' => [ 'The email field is required.' ],
                    'password' => [ 'The password field is required.' ]
                ],
            ],
            'field_name_is_required' => [
                'values' => [
                    'email' => 'user@test.com',
                    'password' => 'password123'
                ],
                'expectedException' => [
                    'name' => [ 'The name field is required.' ]
                ],
            ],
            'field_email_is_required' => [
                'values' => [
                    'name' => 'Test',
                    'password' => 'password123'
                ],
                'expectedException' => [
                    'email' => [ 'The email field is required.' ]
                ],
            ],
            'field_password_is_required' => [
                'values' => [
                    'name' => 'Test',
                    'email' => 'user@test.com',
                ],
                'expectedException' => [
                    'password' => [ 'The password field is required.' ]
                ],
            ]
        ];
    }
}
