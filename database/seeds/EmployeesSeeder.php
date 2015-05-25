
<?php
 
use Illuminate\Database\Seeder;
 
class  EmployeesSeeder extends Seeder {
 
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
      //  DB::table('projects')->delete();
 
        $projects = array(
            ['id' => 1, 'firstName' => 'Jake','lastName' => 'Childress', 'passcode' => 1, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'firstName' => 'Kristin','lastName' => 'Cortez', 'passcode' => 2, 'created_at' => new DateTime, 'updated_at' => new DateTime]
        );
 
        // Uncomment the below to run the seeder
        DB::table('employees')->insert($projects);
    }
 
}
 
