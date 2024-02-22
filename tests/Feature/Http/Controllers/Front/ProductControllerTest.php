<?php

namespace Http\Controllers\Front;

use App\Models\AdminModel;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    private AdminModel $user;
    private AdminModel $admin;

    /**
     * @return void
     */
    private function createUser(bool $isAdmin=false): AdminModel
    {
        return AdminModel::factory()->create(['is_admin'=>$isAdmin]);
    }

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user =$this->createUser();
        $this->admin=$this->createUser(isAdmin: true);
    }

    /**
     * A basic feature test example.
     */
    public function testPaginatedProductsTableDoesntContain11thRecord(): void
    {
        //arrange
//        $user=AdminModel::factory()->create();
        for ($i=0;$i<11;$i++){
            $product=Product::create([
                'name'=>'Product'.$i,
                'price'=>rand(100,999)
            ]);
        }
//        dump($this->admin);
        //act
        $response = $this->actingAs($this->admin)->get('/products');
//        $response->dump();

//        $response = $this->get('/products/all');

        //assert
        $response->assertStatus(200);
        $response->assertViewHas('models',function ($collect) use ($product){
            return !$collect->contains($product);
        });
    }
    public function testAdminCanSeeProductsCreateButton(){

        $response=$this->actingAs($this->admin)->get('/products');

        $response->assertStatus(200);
        $response->assertSee('add');

    }
    public function testNonAdminCannotSeeProductsCreateButton(){

        $response=$this->actingAs($this->user)->get('/products');
        $response->dump();

        $response->assertStatus(200);
        $response->assertDontSee('add');
    }
    public function testAdminCanAccessProductCreatePage(){
        $response=$this->actingAs($this->admin)->get('/salam/salam');
//        $response->dump();
        $response->assertStatus(200);
    }
    public function testNonAdminCannotAccessProductCreatePage(){
        $response=$this->actingAs($this->user)->get('/salam/salam');
//        $response->dump();
        $response->assertStatus(403);
    }
    public function testCreateProductSuccessful(){
        $product=[
            'name'=>'Prod 1',
            'price'=>'123'
        ];

        $response=$this->actingAs($this->admin)->post('/product',$product);
//        $lastProduct=Product::latest()->first();
//        $response->dump();
        $response->assertStatus(302);
        $response->assertRedirect();

//        $this->assertEquals($product['name'],$lastProduct['name']);

        $this->assertDatabaseHas('models',$product);
    }
    public function testProductEditContainsCorrectValues(){
        $product=Product::factory()->create();

        $response=$this->actingAs($this->admin)->get('product/'.$product->id,'/edit');

        $response->assertStatus(200);
        $response->assertSee('value="'.$product->name.'"',false);
        $response->assertSee('value="'.$product->price.'"',false);
        $response->assertViewHas('models',$product);
    }
    public function testProductUpdateValidationErrorRedirectsBackToForm(){
        $product=Product::factory()->create();

        $response=$this->actingAs($this->admin)->put('product/'.$product->id,[
            'name'=>'',
            'price'=>123
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $response->assertInvalid('name');
    }
    public function testProductDeleteSuccessful(){
        $product=Product::factory()->create();

        $response=$this->actingAs($this->admin)->delete('product/'.$product->id);

        $response->assertStatus(302);
        $response->assertRedirect('product');
        $this->assertDatabaseMissing('product',$product->toArray());
        $this->assertDatabaseCount('product',0);
        $this->assertCount(0,Product::count());
    }
    public function testApiReturnsJsonList(){
        $product=Product::factory()->create();

        $response=$this->getJson("/api/product");

        $response->assertJson([$product->toJson()]);
    }
    public function testApiProductStoreSuccessful(){

        $product=[
            'name'=>'product1',
            'price'=>123
        ];
        $response=$this->postJson("/api/product",$product);

        $response->assertStatus(201);
        $response->assertJson($product);
    }
    public function testApiProductInvalidStoreReturnsError(){

    $product=[
        'name'=>'',
        'price'=>123
    ];
        $response=$this->postJson("/api/product",$product);

        $response->assertStatus(422);
        $response->assertJson($product);
    }
}
