<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_categories()
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
    }

    public function test_create_categories()
    {
        $response = $this->post('/api/categories', [
            'name' => 'New Category',
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'New Category',
        ]);
    }

    public function test_get_categories_by_id()
    {
        $category = Category::create(['name' => 'Sample Category']);
        $response = $this->get("/api/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id',
                     'name',
                 ])
                 ->assertJson([
                     'id' => $category->id,
                     'name' => $category->name,
                 ]);
    }

    public function test_update_category_by_id()
    {
        $category = Category::create(['name' => 'Single Category']);
        $response = $this->patch("/api/categories/{$category->id}", [
            'name' => 'test_category_updated',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $category->id,
                     'name' => 'test_category_updated',
                 ]);
    }

    public function test_delete_category_by_id()
    {
        $category = Category::create(['name' => 'To Delete']);

        $response = $this->delete("/api/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([]);
    }
}
