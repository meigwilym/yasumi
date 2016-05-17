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

namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Taiwan.
 */
class Taiwan extends AbstractProvider
{
    use CommonHolidays;
    
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or subregion.
     */
    const ID = 'TW';

    /**
     * Initialize holidays for Taiwan.
     */
    public function initialize()
    {
        $this->timezone = 'Asia/Taipei';

        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
    }
}
