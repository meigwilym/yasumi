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

use Yasumi\Holiday;
use DateTime;
use DateTimeZone;
use DateInterval;

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
        $this->calculateInternationalWorkersDay();
    }

    /**
     * Calculates Labour Day (InternationalWorkersDay).
     *
     * May Day, or Labour Day, is a public holiday in many countries worldwide. It usually occurs around May 1,
     * but the date varies across countries. It is associated the start of spring as well as the celebration
     * of workers.
     *
     * If Labour Day falls on non working day (e.g. weekend) it will be observed on the following workingday.
     *
     * @link http://www.timeanddate.com/holidays/taiwan/labor-day
     */
    public function calculateInternationalWorkersDay()
    {
        $date = new DateTime("$this->year-5-1", new DateTimeZone($this->timezone));

        if (!$this->isWorkingDay($date)) {
            $date->add(new DateInterval('P2D'));
        }

        $this->addHoliday(new Holiday('internationalWorkersDay', [], $date, $this->locale));
    }
}
