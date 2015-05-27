
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class  SalesSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        ///!!WIPES DATA CLEAN FIRST
        DB::table('sales')->delete();


        $filename =  public_path() . "/seeds/sales.json";
        $string = File::get($filename);

        $json_a = json_decode($string, true);
        $arr = $json_a["results"];
        $inner = array();
        foreach ($arr as $val) {

            $data =
                ['date' => $val["date"]["iso"],'am' => isset($val["am"]) ? $val["am"] : 0,'pm' => isset($val["pm"]) ? $val["pm"] : 0,'created_at' => new DateTime, 'updated_at' => new DateTime]
            ;

            array_push($inner,$data);

        }

        // Uncomment the below to run the seeder
        DB::table('sales')->insert($inner);
    }

}

