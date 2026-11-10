<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$s = App\Models\WebsiteSection::where('key', 'hero')->first();
print_r($s ? $s->toArray() : 'NULL');
