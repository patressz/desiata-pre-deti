<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allergens = [
            '- obilniny obsahujúce lepok a výrobky z nich',
            '- kôrovce a výrobky z nich',
            '- vajcia a výrobky z nich',
            '- ryby a výrobky z nich',
            '- arašidy a výrobky z nich',
            '- sójové zrná a výrobky z nich',
            '- mlieko a výrobky z neho, vrátane laktózy',
            '- orechy a výrobky z nich',
            '- zeler a výrobky z neho',
            '- horčica a výrobky z nej',
            '- sezamové semená a výrobky z nich',
            '- oxid siričitý a siričitany',
            '- vlčí bôb a výrobky z neho',
            '- mäkkýše a výrobky z nich',
        ];

        foreach ( $allergens as $key => $allergen ) {

            $key++;

            Allergen::create([
                'allergen_id' => $key,
                'allergen' => $allergen,
            ]);

        }


    }
}
