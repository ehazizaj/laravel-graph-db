<?php

use App\Model\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate_query = 'MATCH (n)DETACH DELETE n';
        DB::delete($truncate_query);

        $ronaldo = new User(['name' => 'Cristiano Ronaldo', 'email' => "cr7@juventus.it", 'age'=> '36']);
        $ronaldo->save();
        $ronaldo->uuid = $ronaldo->id;
        $ronaldo->save();

        $messi = new User(['name' => 'Lionel Messi', 'email' => "messi@barca.es", 'age'=> '34']);
        $messi->save();
        $messi->uuid = $messi->id;
        $messi->save();

        $neymar = new User(['name' => 'Neymar da Silva Santos Júnior', 'email' => "neymar@psg.fr", 'age'=> '28']);
        $neymar->save();
        $neymar->uuid = $neymar->id;
        $neymar->save();

        $lewa = new User(['name' => 'Robert Lewandowski', 'email' => "lewa@munches.de", 'age'=> '32']);
        $lewa->save();
        $lewa->uuid = $lewa->id;
        $lewa->save();

        $dybala = new User(['name' => 'Paulo Dybala', 'email' => "dybala@juventus.it", 'age'=> '26']);
        $dybala->save();
        $dybala->uuid = $dybala->id;
        $dybala->save();

        $benzema = new User(['name' => 'Karim Benzema', 'email' => "benzema@madrid.es", 'age'=> '32']);
        $benzema->save();
        $benzema->uuid = $benzema->id;
        $benzema->save();

        $salah = new User(['name' => 'Mohamed Salah', 'email' => "mosalah@liverpool.en", 'age'=> '28']);
        $salah->save();
        $salah->uuid = $salah->id;
        $salah->save();

        $mbappe = new User(['name' => 'Kylian Mbappe', 'email' => "mbappe@psg.fr", 'age'=> '20']);
        $mbappe->save();
        $mbappe->uuid = $mbappe->id;
        $mbappe->save();

        $ronaldo->following()->save($messi);
        $messi->following()->save($neymar);
        $messi->following()->save($lewa);
        $dybala->following()->save($neymar);
        $dybala->following()->save($benzema);
        $benzema->following()->save($salah);
        $messi->following()->save($salah);
        $mbappe->following()->save($benzema);
        $mbappe->followers()->save($messi);
    }
}
