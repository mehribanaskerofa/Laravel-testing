<?php

namespace Http\Controllers\Front;

use App\Models\AdminModel;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLoginRedirectsToProducts(){
        AdminModel::create([
            'email'=>'admin@admin1.com',
            'password'=>bcrypt('password'),
            'is_admin'=>0,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

        $response=$this->post('admin/login',[
            'email'=>'admin@admin.com',
            'password'=>'password'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect();
    }
    public function testUnauthenticatedUserCannotAccessProduct(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(302);
        $response->assertRedirect();
    }
}
