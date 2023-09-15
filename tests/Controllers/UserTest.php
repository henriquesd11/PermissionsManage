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
        $currentUser = User::get();
        User::factory(3)->create();
        Auth::setUser(User::take(1)->first());
        $response = $this->get('users/list');
        $content = json_decode($response->getContent(), true);

        $response->assertOk();
        $this->assertEquals(count($content['list']), $currentUser->count() + 3);
    }
}
