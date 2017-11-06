<?php

use Illuminate\Database\Seeder;

class CategoryCostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('category_costs')->get()->count() == 0)
        {
            DB::table('category_costs')->insert([
                [
                    'name' => 'Água',
                    'user_id' => 1
                ], [
                    'name' => 'Luz',
                    'user_id' => 1
                ], [
                    'name' => 'Cartão de Crédito',
                    'user_id' => 1
                ], [
                    'name' => 'Banco Santander',
                    'user_id' => 1
                ], [
                    'name' => 'Super Mercado',
                    'user_id' => 1
                ], [
                    'name' => 'Combustível',
                    'user_id' => 1
                ], [
                    'name' => 'Gás',
                    'user_id' => 1
                ], [
                    'name' => 'Celular',
                    'user_id' => 1
                ], [
                    'name' => 'Manutenção do veículo',
                    'user_id' => 1
                ], [
                    'name' => 'Lazer',
                    'user_id' => 1
                ]
            ]);
        }
    }
}
