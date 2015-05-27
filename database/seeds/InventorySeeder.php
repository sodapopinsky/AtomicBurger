
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
class  InventorySeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        ///!!WIPES DATA CLEAN FIRST
        DB::table('inventory_items')->delete();

        $filename =  public_path() . "/seeds/inventory.json";
        $string = File::get($filename);


        $json_a = json_decode($string, true);
        $arr = $json_a["results"];
        $inner = array();
        foreach ($arr as $val) {

            $data =
                ['name' => $val["name"], 'measurement' => $val["measurement"],'par' => isset($val["par"]) ? $val["par"] : 0, 'quantityOnHand' => $val["quantityOnHand"],'created_at' => new DateTime, 'updated_at' => new DateTime]
            ;

            array_push($inner,$data);

        }

        // Uncomment the below to run the seeder
        DB::table('inventory_items')->insert($inner);
    }

}

