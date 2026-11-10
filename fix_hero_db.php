<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sec = App\Models\WebsiteSection::where('key', 'hero')->first();
if ($sec) {
    echo "Old content: " . $sec->content . "\n";
    $sec->content = 'We provide advanced induction heating machinery designed for precision, efficiency, reliability, and demanding industrial applications.';
    $sec->save();
    \Illuminate\Support\Facades\Cache::forget(App\Models\WebsiteSection::CACHE_KEY);
    echo "Updated hero content in DB successfully!\n";
} else {
    echo "Hero section not found!\n";
}
