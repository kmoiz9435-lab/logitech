<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== settings matching logo/favicon/image ===\n";
foreach (DB::table('website_settings')->get() as $s) {
    if (preg_match('/logo|favicon|image|bg|photo/i', $s->key)) {
        echo $s->key . ' => ' . $s->value . PHP_EOL;
    }
}

echo "\n=== any setting containing localhost/http ===\n";
foreach (DB::table('website_settings')->get() as $s) {
    if (str_contains((string) $s->value, 'http')) {
        echo $s->key . ' => ' . $s->value . PHP_EOL;
    }
}

echo "\n=== sample media columns ===\n";
foreach (['product_categories' => ['image'], 'products' => ['image'], 'gallery_images' => ['image_path', 'image'], 'industries' => ['image'], 'why_choose_items' => ['image']] as $t => $cols) {
    if (!DB::getSchemaBuilder()->hasTable($t)) { echo "$t missing\n"; continue; }
    $rows = DB::table($t)->limit(3)->get();
    echo "-- $t\n";
    foreach ($rows as $r) {
        $out = [];
        foreach ((array) $r as $k => $v) {
            if (in_array($k, $cols) || preg_match('/image|photo|logo|file|path/i', $k)) {
                $out[$k] = $v;
            }
        }
        echo json_encode($out) . PHP_EOL;
    }
}

echo "\n=== sections with images ===\n";
foreach (DB::table('website_sections')->get() as $s) {
    if (preg_match('/image|bg|photo|logo/i', $s->field ?? '')) {
        echo ($s->section ?? '') . '.' . ($s->field ?? '') . ' => ' . substr((string) $s->value, 0, 120) . PHP_EOL;
    }
}
