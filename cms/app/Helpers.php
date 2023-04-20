<?php
use LukaPeharda\TailwindCssColorPaletteGenerator\Color;
use LukaPeharda\TailwindCssColorPaletteGenerator\PaletteGenerator;

// Generates a Tailwind color palette based on the accent color preference.
function getAppColorPallete() {
    $defaultColorHex = config('sightcms.color');
    $accentColorHex = config('preferences.identity.accent_color', $defaultColorHex);

    $accentColor = Color::fromHex($accentColorHex);

    $paletteGenerator = new PaletteGenerator;
    $paletteGenerator->setBaseColor($accentColor);
    $paletteGenerator->setBaseValue(700);
    $palette = $paletteGenerator->getPalette();

    $paletteHex = [];

    foreach($palette as $step => $color) {
        $paletteHex[$step] = '#' . $color->getHex();
    }

    return $paletteHex;
}

function getReadableFileSize($size, $precision = 2) {
    if($size > 0) {
        $size = (int) $size;
        $base = log($size) / log(1024);
        $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }
    
    return $size;
}