import preset from './vendor/filament/support/tailwind.config.preset'

module.exports = {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-badgeable-column/resources/**/*.blade.php',
    ],
}
