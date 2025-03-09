<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

it('displays the Test component with correct props for a logged-in user', function () {
    // Arrange: Create and log in a user
    $user = User::factory()->create();
    $this->actingAs($user);

    // Act: Visit the /test page
    $response = $this->get('/test');

    // Assert: Check the response and Inertia component
    $response/*->assertInertia(function (Assert $page) {
          dd($page->toArray()); // Inspect the component and props
      })*/
        ->assertStatus(200)
        ->assertInertia(function (Assert $page) {
            $page
                ->component('test2');
        });
});

it('redirects unauthenticated users away from /test', function () {
    $response = $this->get('/test');
    $response->assertStatus(302)->assertRedirect('/login');
});
