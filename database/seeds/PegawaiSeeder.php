<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id_pegawai');
        //     $table->integer('nip');
        //     $table->string('nama', 100);
        //     $table->integer('no_ktp');
        //     $table->integer('no_hp');
        //     $table->string('no_npwp', 100);
        //     $table->string('pangkat', 100);
        //     $table->string('jabatan', 100);
        //     $table->string('opd', 100);

        $faker = Faker::create('id_ID');
        
        for($i = 1; $i<= 50; $i++){
            DB::table('data_pegawai')->insert([
                'nip'=>$faker->numberBetween(25,40),
                'nama'=>$faker->name,
                'no_ktp'=>$faker->numberBetween(25,40),
                'no_hp'=>$faker->numberBetween(25,40),
                'no_npwp'=>$faker->uuid,
                'pangkat'=>$faker->jobTitle,
                'jabatan'=>$faker->jobTitle,
                'opd'=>$faker->company
            ]);
        }        
    }
}
