<?php

namespace Tests\Unit\Services\RepositoryService;

use App\Http\Requests\AdvRequest;
use App\Models\Adv;
use App\Repositories\AdvRepository;
use App\Services\FileUploadService;
use App\Services\RepositoryService\AdvService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;


class AdvServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $_fileUploadService;
    private $_advRepository;
    private $_advService;
    protected function setUp(): void
    {
        parent::setUp();
        $this->_fileUploadService=\Mockery::mock(FileUploadService::class);
        $this->_advRepository=\Mockery::mock(AdvRepository::class);
        $this->_advService = new AdvService($this->_advRepository, $this->_fileUploadService);

    }
    protected function tearDown(): void
    {
        parent::tearDown();

        // Mock nesneleri temizle
        \Mockery::close();    }

    /**
     * A basic unit test example.
     */
    public function testStore(): void
    {
        // Arrange
        $advService = new AdvService($this->_advRepository, $this->_fileUploadService);

        // Örnek bir UploadedFile oluşturun
        $fakeImage = UploadedFile::fake()->image('fake_image.jpg');

        // Simüle edilen AdvRequest oluşturun
        $advRequest = new AdvRequest();
        $advRequest->initialize([
            'company_id' => 1,
            'image' => $fakeImage,
            'en' => ['name' => 'Name', 'title' => 'Title'],
            'az' => ['name' => 'Name', 'title' => 'Title'],
            'ru' => ['name' => 'Name', 'title' => 'Title'],
        ]);

        $this->_fileUploadService
            ->shouldReceive('uploadFile')
            ->once()
            ->with(
                \Mockery::type(UploadedFile::class), // Beklenen parametre: UploadedFile türünde bir dosya
                'adv_images' // Beklenen diğer parametre: Dosyanın yüklenmesi için hedef klasör
            )
            ->andReturn('path/to/uploaded/file.jpg'); // Yüklenen dosyanın döndüğü değer


        // AdvRepository için beklenen save çağrısını ayarlayın
        $this->_advRepository
            ->shouldReceive('save')
            ->once()
            ->with(
                \Mockery::type('array'), // Burada beklenen parametreleri kontrol edin
                \Mockery::type(Adv::class)
            )
            ->andReturn(new Adv());

        // Act
        $response = $this->_advService->store($advRequest);

        // Assert
        $this->assertInstanceOf(Adv::class, $response);
    }
    public function testCachedAdvs(){
        // Arrange
        $advService = new AdvService($this->_advRepository, $this->_fileUploadService);
        $cachedData = ['adv1', 'adv2']; // Örnek bir cache verisi

        // Expectation: Cache::rememberForever metodunun çağrılması
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('advs', \Closure::class) // Closure olarak bekleniyor
            ->andReturnUsing(function ($key, $closure) use ($cachedData) {
                return $closure(); // Closure'ı çağırarak örnek cache verisini döndür
            });

        // Expectation: Repository'nin all metodu çağrılması
        $this->_advRepository
            ->shouldReceive('all')
            ->once()
            ->with(['translations'])
            ->andReturn($cachedData);

        // Act
        $result = $this->_advService->CachedAdvs();

        // Assert
        $this->assertEquals($cachedData, $result);



    }
    public function testMockHttp()
    {
        // This api is supposed to return a list of countries in JSON format,
        // we can mock it so that it only returns Italy.
        Http::fake([
            'https://restcountries.com/v3.1/all' => Http::response(
                [
                    'name' => 'Azerbaijan',
                    'code' => 'AZE'
                ],
                200
            ),
        ]);
        $response = Http::get('https://restcountries.com/v3.1/all');

        $this->assertJsonStringEqualsJsonString(
            $response->body(),
            json_encode([
                'name' => 'Azerbaijan',
                'code' => 'AZE'
            ],)
        );
    }

}
