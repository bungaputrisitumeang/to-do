<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_creates_task_and_tags()
    {
        $response = $this->post(route('item.store'), [
            'item' => 'Buy Groceries | food,urgent',
        ]);

        $this->assertDatabaseHas('tasks', ['name' => 'Buy Groceries']);
        $this->assertDatabaseHas('tags', ['tag_name' => 'food']);
        $this->assertDatabaseHas('tags', ['tag_name' => 'urgent']);

        $response->assertRedirect(route('dashboard'));
    }

    public function test_insert_with_only_task_name()
    {
        $response = $this->post(route('item.store'), [
            'item' => 'Workout',
        ]);

        $this->assertDatabaseHas('tasks', ['name' => 'Workout']);
        $this->assertDatabaseCount('tags', 0);

        $response->assertRedirect(route('dashboard'));
    }

    public function test_delete_removes_task_and_tags()
    {
        $task = Task::create(['name' => 'Sleep']);
        Tag::create(['tag_name' => 'rest', 'task_id' => $task->id]);

        $response = $this->delete(route('item.destroy', $task->id));

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
        $this->assertDatabaseMissing('tags', ['tag_name' => 'rest']); // tag juga harus hilang

        $response->assertRedirect(route('dashboard'));
    }

}

?>