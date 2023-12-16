import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-badgeable-column/resources/**/*.blade.php',
        './vendor/andrewdwallo/filament-selectify/resources/views/**/*.blade.php',
    ],
}
