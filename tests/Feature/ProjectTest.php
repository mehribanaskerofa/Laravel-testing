<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateProject()
    {
        $project = Project::factory()->create();

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
        ]);
//        $this->assertEquals(3, Project::count());
        $this->assertInstanceOf(Project::class, $project);
    }
}
