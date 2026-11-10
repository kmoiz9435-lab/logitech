<?php
$imgPath = 'C:/Users/dell/.gemini/antigravity/brain/376bc479-ca38-4220-93a8-25ae00e49515/.user_uploaded/media_1794327309621_51969740.png';
$src = imagecreatefromstring(file_get_contents($imgPath));
$w = imagesx($src); // 976
$h = imagesy($src); // 457

// The hero area is y = 47 to y = 457 (h = 410)
$heroH = $h - 47;
$heroW = $w;

$banner = imagecreatetruecolor($heroW, $heroH);
// Copy the hero part from src
imagecopy($banner, $src, 0, 0, 0, 47, $heroW, $heroH);

// On the left side (x=0 to x=460), the mockup had text.
// We want the text to be live HTML text rendered by Blade!
// So from x=0 to x=420, it should be pure white (#FFFFFF),
// and from x=420 to x=520, it smoothly transitions into the machine picture!
$white = imagecolorallocate($banner, 255, 255, 255);

// Let's create a clean blend
$cleanBanner = imagecreatetruecolor($heroW, $heroH);
// Fill with white
imagefill($cleanBanner, 0, 0, $white);
// Copy right side of banner (x=450 to 976)
imagecopy($cleanBanner, $banner, 450, 0, 450, 0, $heroW - 450, $heroH);

// Smooth blend zone from x=380 to x=500
for ($x = 380; $x < 500; $x++) {
    $alpha = ($x - 380) / (500 - 380); // 0 at 380, 1 at 500
    for ($y = 0; $y < $heroH; $y++) {
        $rgb = imagecolorat($banner, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        // Blend with white (255, 255, 255)
        $newR = (int)(255 * (1 - $alpha) + $r * $alpha);
        $newG = (int)(255 * (1 - $alpha) + $g * $alpha);
        $newB = (int)(255 * (1 - $alpha) + $b * $alpha);
        $color = imagecolorallocate($cleanBanner, $newR, $newG, $newB);
        imagesetpixel($cleanBanner, $x, $y, $color);
    }
}

// Also upscale slightly for crisp high-DPI screens: width 1920 x 800
$hiResW = 1920;
$hiResH = 806;
$hiRes = imagecreatetruecolor($hiResW, $hiResH);
imagecopyresampled($hiRes, $cleanBanner, 0, 0, 0, 0, $hiResW, $hiResH, $heroW, $heroH);

// Overwrite all hero targets so whatever method loads it gets the EXACT image from Image 1!
$targets = [
    'C:/xampp/htdocs/website 2/public/uploads/content/o6K2mkYfRlWSH1zFnnVbq4xz.jpg',
    'C:/xampp/htdocs/website 2/public/uploads/seed/hero-induction.jpg',
    'C:/xampp/htdocs/website 2/public/uploads/content/hero_induction_ring.jpg',
    'C:/xampp/htdocs/website 2/public/uploads/content/hero_ring_machine.jpg',
];

foreach ($targets as $t) {
    if (file_exists(dirname($t))) {
        imagejpeg($hiRes, $t, 96);
        echo "Successfully updated: $t\n";
    }
}

// Also copy to C:\website 2
$wsTargets = [
    'C:/website 2/public/uploads/content/o6K2mkYfRlWSH1zFnnVbq4xz.jpg',
    'C:/website 2/public/uploads/seed/hero-induction.jpg',
    'C:/website 2/public/uploads/content/hero_induction_ring.jpg',
    'C:/website 2/public/uploads/content/hero_ring_machine.jpg',
];
foreach ($wsTargets as $t) {
    if (!file_exists(dirname($t))) {
        mkdir(dirname($t), 0777, true);
    }
    imagejpeg($hiRes, $t, 96);
    echo "Successfully updated workspace: $t\n";
}
