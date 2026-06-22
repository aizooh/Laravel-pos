use Illuminate\Support\Facades\Hash; // Add this to the top of the file
public function run(): void
{
    if (\App\Models\User::where('email', 'admin@pos.com')->doesntExist()) {
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@pos.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Attendant User',
            'email'    => 'attendant@pos.com',
            'password' => Hash::make('password'),
            'role'     => 'attendant',
        ]);
    }
}