<?php

namespace Http\Controllers\Admin;

use App\Models\Adv;
use Database\Factories\AdvFactory;
use PhpParser\Node\Expr\Print_;
use Tests\TestCase;

class AdvControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     **/
    public function Index(): void
    {
        Adv::factory(3)->create();
//        AdvFactory::new()->count(5)->create(
//  ['price'=>999]
//);

        $adv=Adv::first();

        $response = $this->get('/adv');

        $response->assertStatus(200);
        $response->assertViewHas('models',function ($collect) use ($adv){
            return $collect->contains($adv);
//                || $collect->isEmpty();;
        });
    }
}
