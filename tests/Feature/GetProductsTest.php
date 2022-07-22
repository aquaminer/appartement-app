<?php

namespace Tests\Feature;

use App\Models\Apartment;
use Database\Factories\ApartmentFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function collect;
use function mt_rand;
use function route;

/** @see ApartmentController */
class GetProductsTest extends TestCase
{
    use RefreshDatabase;

    public function equalsProvider(): array
    {
        return [
            ['bedrooms', 1],
            ['bathrooms', 1],
            ['storeys', 1],
            ['garages', 1],
        ];
    }

    /** @dataProvider equalsProvider */
    public function testOneEqualsFilter(string $param, int $value)
    {
        ApartmentFactory::new([
            $param => mt_rand($value, $value + 10),
        ])->count(10)->create();

        ApartmentFactory::new([
            $param => $value,
        ])->create();

        $apartments = Apartment::query()->scopes([$param => $value])->get()->toArray();

        $this->get(route('products-get', [$param => $value]))
            ->assertJson($apartments);
    }

    public function testNameFilter()
    {
        ApartmentFactory::times(10)->create();

        $apartment1 = ApartmentFactory::new([
            'name' => 'name123',
        ])->create();
        $apartment2 = ApartmentFactory::new([
            'name' => '123name',
        ])->create();

        $apartments = collect([$apartment1, $apartment2])->toArray();

        $this->get(route('products-get', ['name' => 'name']))
            ->assertJson($apartments);
    }

    public function testPriceFilter()
    {
        ApartmentFactory::times(10)->create();

        $apartment1 = ApartmentFactory::new([
            'price' => 10,
        ])->create();
        $apartment2 = ApartmentFactory::new([
            'price' => 15,
        ])->create();


        $this->get(route('products-get', ['price' => [14, 15]]))
            ->assertJson(
                collect([$apartment2])->toArray()
            );

        $this->get(route('products-get', ['price' => [10, 15]]))
            ->assertJson(
                collect([$apartment1, $apartment2])->toArray()
            );
    }

    public function testSomeFilters(): void
    {
        ApartmentFactory::times(10)->create();

        $apartments = ApartmentFactory::new([
            'bathrooms' => 15,
            'storeys' => 17,
        ])->count(3)->create();

        $this->get(route('products-get', [
            'bathrooms' => 15,
            'storeys' => 17,
        ]))
            ->assertJson($apartments->toArray());
    }
}
