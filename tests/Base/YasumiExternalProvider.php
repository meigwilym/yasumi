<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Base;

use Yasumi\ProviderInterface;

/**
 * Class YasumiExternalProvider.
 *
 * Class for testing the use of an external holiday provider class.
 */
class YasumiExternalProvider implements ProviderInterface
{
    /**
     * Initialize country holidays.
     */
    public function initialize()
    {
        // We don't actually have to do anything here.
    }
}
