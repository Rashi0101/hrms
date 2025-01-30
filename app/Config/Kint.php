<?php

namespace Config;

use Kint\Parser\ConstructablePluginInterface;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use Kint\Renderer\AbstractRenderer;
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
=======
use Kint\Renderer\AbstractRenderer;
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
use Kint\Renderer\Rich\TabPluginInterface;
use Kint\Renderer\Rich\ValuePluginInterface;

/**
 * --------------------------------------------------------------------------
 * Kint
 * --------------------------------------------------------------------------
 *
 * We use Kint's `RichRenderer` and `CLIRenderer`. This area contains options
 * that you can set to customize how Kint works for you.
 *
 * @see https://kint-php.github.io/kint/ for details on these settings.
 */
class Kint
{
    /*
    |--------------------------------------------------------------------------
    | Global Settings
    |--------------------------------------------------------------------------
    */

    /**
     * @var list<class-string<ConstructablePluginInterface>|ConstructablePluginInterface>|null
     */
    public $plugins;

    public int $maxDepth           = 6;
    public bool $displayCalledFrom = true;
    public bool $expanded          = false;

    /*
    |--------------------------------------------------------------------------
    | RichRenderer Settings
    |--------------------------------------------------------------------------
    */
    public string $richTheme = 'aante-light.css';
    public bool $richFolder  = false;
<<<<<<< HEAD
<<<<<<< HEAD
=======
    public int $richSort     = AbstractRenderer::SORT_FULL;
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
=======
    public int $richSort     = AbstractRenderer::SORT_FULL;
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

    /**
     * @var array<string, class-string<ValuePluginInterface>>|null
     */
    public $richObjectPlugins;

    /**
     * @var array<string, class-string<TabPluginInterface>>|null
     */
    public $richTabPlugins;

    /*
    |--------------------------------------------------------------------------
    | CLI Settings
    |--------------------------------------------------------------------------
    */
    public bool $cliColors      = true;
    public bool $cliForceUTF8   = false;
    public bool $cliDetectWidth = true;
    public int $cliMinWidth     = 40;
}
