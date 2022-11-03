<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UnitController
 */
class UnitControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $units = Unit::factory()->count(3)->create();

        $response = $this->get(route('unit.index'));

        $response->assertOk();
        $response->assertViewIs('unit.index');
        $response->assertViewHas('units');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('unit.create'));

        $response->assertOk();
        $response->assertViewIs('unit.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UnitController::class,
            'store',
            \App\Http\Requests\UnitStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $unit = $this->faker->word;

        $response = $this->post(route('unit.store'), [
            'unit' => $unit,
        ]);

        $units = Unit::query()
            ->where('unit', $unit)
            ->get();
        $this->assertCount(1, $units);
        $unit = $units->first();

        $response->assertRedirect(route('unit.index'));
        $response->assertSessionHas('unit.id', $unit->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $unit = Unit::factory()->create();

        $response = $this->get(route('unit.show', $unit));

        $response->assertOk();
        $response->assertViewIs('unit.show');
        $response->assertViewHas('unit');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $unit = Unit::factory()->create();

        $response = $this->get(route('unit.edit', $unit));

        $response->assertOk();
        $response->assertViewIs('unit.edit');
        $response->assertViewHas('unit');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UnitController::class,
            'update',
            \App\Http\Requests\UnitUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $unit = Unit::factory()->create();
        $unit = $this->faker->word;

        $response = $this->put(route('unit.update', $unit), [
            'unit' => $unit,
        ]);

        $unit->refresh();

        $response->assertRedirect(route('unit.index'));
        $response->assertSessionHas('unit.id', $unit->id);

        $this->assertEquals($unit, $unit->unit);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $unit = Unit::factory()->create();

        $response = $this->delete(route('unit.destroy', $unit));

        $response->assertRedirect(route('unit.index'));

        $this->assertDeleted($unit);
    }
}
