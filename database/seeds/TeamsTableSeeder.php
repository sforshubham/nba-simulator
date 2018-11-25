<?php

use Illuminate\Database\Seeder;


class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$timestamp = date('Y-m-d H:i:s');
    	DB::table('teams')->truncate();
        DB::table('teams')->insert([
			['name' => 'Boston Celtics', 'color' => '#3b5998', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Brooklyn Nets', 'color' => '#6897bb', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'New York Knicks', 'color' => '#660066', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Philadelphia 76ers', 'color' => '#088da5', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Toronto Raptors', 'color' => '#0e2f44', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Chicago Bulls', 'color' => '#daa520', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Cleveland Cavaliers', 'color' => '#ff6666', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Detroit Pistons', 'color' => '#f6546a', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Indiana Pacers', 'color' => '#003366', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Milwaukee Bucks', 'color' => '#ff7373', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Atlanta Hawks', 'color' => '#ffa500', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Charlotte Hornets', 'color' => '#ffe4e1', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Miami Heat', 'color' => '#008080', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Orlando Magic', 'color' => '#bed2e7', 'created_at' => $timestamp, 'updated_at' => $timestamp],
			['name' => 'Washington Wizards', 'color' => '#42dff4', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);
    }
}
