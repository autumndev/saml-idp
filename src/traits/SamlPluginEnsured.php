<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 */

namespace flipbox\saml\idp\traits;

use flipbox\saml\core\SamlPluginInterface;
use flipbox\saml\core\traits\EnsureSamlPlugin;
use flipbox\saml\idp\Saml;

trait SamlPluginEnsured
{

    /**
     * @see EnsureSamlPlugin
     * @return SamlPluginInterface
     */
    protected function getSamlPlugin(): SamlPluginInterface
    {
        return Saml::getInstance();
    }
}
