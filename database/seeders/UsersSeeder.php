use App\Models\User; // Regular user model
use Bagisto\Shop\Models\Admin; // Admin model

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        Admin::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('skjb%hgvaHSJksj'),
            'is_active' => 1,
            'email_verified_at' => Carbon::now(),
        ]);

        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'regularuser@gmail.com',
            'password' => Hash::make('regularpassword'),
        ]);
    }
}
