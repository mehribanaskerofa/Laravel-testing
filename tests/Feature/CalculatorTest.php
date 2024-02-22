<?php

namespace Tests\Feature;

use App\Models\House;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SebastianBergmann\Complexity\Calculator;
use Tests\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testProjectRelationship()
    {
        // Örnek verileri hazırla
        $project = factory(Project::class)->create();
        $house = factory(House::class)->create(['project_id' => $project->id]);

        // House modeli ile ilişkilendirilmiş Project modelini al
        $relatedProject = $house->project;

        // İlişkilendirilmiş Project modelinin varlığını doğrula
        $this->assertInstanceOf(Project::class, $relatedProject);

        // İlişkilendirilmiş Project modelinin "id"si, beklendiği gibi aynı mı kontrol et
        $this->assertEquals($project->id, $relatedProject->id);
    }
}
