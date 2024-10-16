<?php
namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_projects()
    {
        Project::factory()->count(3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_create_project()
    {
        $projectData = [
            'title' => 'Test Project',
            'description' => 'This is a test project',
            'image_url' => 'https://example.com/image.jpg',
            'project_url' => 'https://example.com/project',
        ];

        $response = $this->postJson('/api/projects', $projectData);

        $response->assertStatus(201)
            ->assertJson($projectData);
    }

    public function test_can_update_project()
    {
        $project = Project::factory()->create();
        $updatedData = ['title' => 'Updated Project'];

        $response = $this->putJson("/api/projects/{$project->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);
    }

    public function test_can_delete_project()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}