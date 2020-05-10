<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private function sampleTask()
    {
        return [
            'name'                   => 'Test Task',
            'description'            => 'this is a test task',
            'completion_date'        => '2020-02-02',
            'target_completion_date' => '2020-02-02',
        ];
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexRedirecToTask()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/task');
    }

    /**
     * Test create view renders.
     *
     * @return void
     */
    public function testCreateView()
    {
        $response = $this->get('/task/create');

        $response->assertStatus(200);
    }

    /**
     * Test insert task
     *
     * @return void
     */
    public function testInsertTask()
    {
        $response = $this->post('/task', $this->sampleTask());

        $response->assertStatus(302);
        $this->assertCount(1, Task::all());
    }

    /**
     * Test new task requires a name
     *
     * @return void
     */
    public function testInsertTaskNameRequired()
    {
        $data = $this->sampleTask();
        $data['name'] = '';

        $response = $this->post('/task', $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    /**
     * Test task can be updated
     *
     * @return void
     */
    public function testUpdateTask()
    {
        $response = $this->post('/task', $this->sampleTask());

        $task = Task::first();

        $response = $this->patch($task->path(), [
            'name' => 'new name',
            'description' => 'new description',
            'target_completion_date' => '2020-02-02',
        ]);

        $this->assertEquals('new name', Task::first()->name);
        $response->assertStatus(302);
        $this->assertCount(1, Task::all());
    }

    /**
     * Test task can be deleted
     *
     * @return void
     */
    public function testDeleteTask()
    {
        $this->post('/task', $this->sampleTask());

        $task = Task::first();

        $this->assertCount(1, Task::all());

        $this->delete($task->path());

        $this->assertCount(0, Task::all());
    }
}
