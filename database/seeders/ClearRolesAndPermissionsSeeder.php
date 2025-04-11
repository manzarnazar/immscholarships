namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearRolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Clear role_permission table
        DB::table('role_permission')->truncate();

        // Clear permissions table
        DB::table('permissions')->truncate();

        // Clear roles table
        DB::table('roles')->truncate();

        $this->command->info('All roles and permissions have been deleted.');
    }
}
