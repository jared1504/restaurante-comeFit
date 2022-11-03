<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TableController
 */
class TableControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $tables = Table::factory()->count(3)->create();

        $response = $this->get(route('table.index'));

        $response->assertOk();
        $response->assertViewIs('table.index');
        $response->assertViewHas('tables');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('table.create'));

        $response->assertOk();
        $response->assertViewIs('table.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TableController::class,
            'store',
            \App\Http\Requests\TableStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('table.store'), [
            'status' => $status,
        ]);

        $tables = Table::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $tables);
        $table = $tables->first();

        $response->assertRedirect(route('table.index'));
        $response->assertSessionHas('table.id', $table->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $table = Table::factory()->create();

        $response = $this->get(route('table.show', $table));

        $response->assertOk();
        $response->assertViewIs('table.show');
        $response->assertViewHas('table');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $table = Table::factory()->create();

        $response = $this->get(route('table.edit', $table));

        $response->assertOk();
        $response->assertViewIs('table.edit');
        $response->assertViewHas('table');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TableController::class,
            'update',
            \App\Http\Requests\TableUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $table = Table::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('table.update', $table), [
            'status' => $status,
        ]);

        $table->refresh();

        $response->assertRedirect(route('table.index'));
        $response->assertSessionHas('table.id', $table->id);

        $this->assertEquals($status, $table->status);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $table = Table::factory()->create();

        $response = $this->delete(route('table.destroy', $table));

        $response->assertRedirect(route('table.index'));

        $this->assertDeleted($table);
    }
}
