<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = \App\Models\User::where('role', 'admin')->first();
if ($u) {
    $u->email = 'admin@gmail.com';
    $u->password = \Illuminate\Support\Facades\Hash::make('admin@123');
    $u->save();
    echo "UPDATED:" . $u->email . PHP_EOL;
} else {
    echo "NO_ADMIN_FOUND" . PHP_EOL;
}
