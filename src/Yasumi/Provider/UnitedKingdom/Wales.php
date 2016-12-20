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

namespace Yasumi\Provider\UnitedKingdom;

use Yasumi\Provider\UnitedKingdom;

/**
 * Provider for all holidays in Wales (United Kingdom).
 *
 * @link https://en.wikipedia.org/wiki/Wales
 */
class Wales extends UnitedKingdom
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'GB-WLS';

    /**
     * Initialize holidays for Wales (United Kingdom).
     */
    public function initialize()
    {
        parent::initialize();
    }
}