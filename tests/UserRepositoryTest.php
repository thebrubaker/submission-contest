<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\Eloquent\UserRepositoryContract as UserRepository;
use App\User;

class UserRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    protected $repo;

    function __construct() {
        $this->repo = new UserRepository(new User);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $password = bcrypt('test');
        $attributes = [
            'email' => 'pk.joel@gmail.com',
            'password' => $password
        ];
        $user = $this->repo->create($attributes);
        $user2 = User::where('id', $user->id)->first();
        $this->assertEquals($user->email, $user2->email);
    }

    public function test_find_by_email()
    {
        $password = bcrypt('test');
        $attributes = [
            'email' => 'pk.joel@gmail.com',
            'password' => $password
        ];
        $user = $this->repo->create($attributes);
        $user2 = $this->repo->findByEmail($user->email);
        $this->assertEquals($user->id, $user2->id);
    }

}