<?php
$imgPath = 'C:/Users/dell/.gemini/antigravity/brain/376bc479-ca38-4220-93a8-25ae00e49515/.user_uploaded/media_1794327309621_51969740.png';
$src = imagecreatefromstring(file_get_contents($imgPath));
$w = imagesx($src);
$h = imagesy($src);

// Let's create an image for hero background:
// From x=350 to 976 (width=626), y=47 to 457 (height=410)
// With a soft alpha gradient on the left edge so it blends seamlessly into pure white!
$cropW = $w - 350;
$cropH = $h - 47;
$heroBg = imagecreatetruecolor($cropW, $cropH);
imagecopy($heroBg, $src, 0, 0, 350, 47, $cropW, $cropH);

// Save to public/uploads/content/hero_ring_machine.jpg
$target = 'C:/xampp/htdocs/website 2/public/uploads/content/hero_ring_machine.jpg';
imagejpeg($heroBg, $target, 98);
echo "Saved $target: {$cropW}x{$cropH}\n";
