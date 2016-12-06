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
        $this->calculate228PeaceMemorialDay();

        $this->calculateSubstituteHolidays();
    }

    /**
     * Calculates Labour Day (InternationalWorkersDay).
     *
     * May Day, or Labour Day, is a public holiday in many countries worldwide. It usually occurs around May 1,
     * but the date varies across countries. It is associated the start of spring as well as the celebration
     * of workers.
     *
     * If Labour Day falls on non working day (e.g. weekend), a deferred day off will be granted. 
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

    /**
     * Calculates 228 Peace Memorial Day.
     *
     * Commemorates the February 28 Incident in 1947. On 27 February 1947 a dispute between a female cigarette vendor
     * and a Chinese official started civil unrest and open rebellions. The Chinese responded with severe military force
     * and put Taiwan under martial law. Martial law was only lifted in 1987.
     * It wasn't until 1995 that the event was first publicly acknowledged by a Taiwanese head of state and 28 February
     * made a national holiday to commemorate the events of 1947. Since then, several monuments have been erected in
     * memory of the massacre and Taipei New Park was renamed 228 Memorial Park.
     *
     * If 228 Peace Memorial Day falls on non working day (e.g. weekend), a deferred day off will be granted.
     * In case it falls on a Saturday, the deferred day off is on the preceding workday; Otherwise, it falls on a Sunday
     * the deferred day off is on he following workday.
     *
     * @link http://www.officeholidays.com/countries/taiwan/peace_memorial_day.php
     */
    public function calculate228PeaceMemorialDay()
    {
        if ($this->year < 1995) {
            return;
        }

        $date = new DateTime("$this->year-2-28", new DateTimeZone($this->timezone));

        if (in_array($date->format('w'), [0])) {
            $date->sub(new DateInterval('P1D'));
        }

        if (in_array($date->format('w'), [6])) {
            $date->add(new DateInterval('P1D'));
        }

        $this->addHoliday(new Holiday('228PeaceMemorialDay', ['zh_Hant_TW' => '228和平紀念日'], $date, $this->locale));
    }

    /**
     * Calculate the substitute holidays.
     *
     * When the memorial day or holiday falls on a Saturday or Sunday, a deferred day off will be granted.
     * In case it falls on a Saturday, the deferred day off is on the preceding workday; Otherwise, it falls on a Sunday
     * the deferred day off is on he following workday.
     */
    private function calculateSubstituteHolidays() {

        // Get initial list of holidays and iterator
        $datesIterator = $this->getIterator();

        // Loop through all defined holidays
        while ($datesIterator->valid()) {
            //echo  $datesIterator->current()->format('Y').PHP_EOL;
            $datesIterator->next();
        }

    }    
}
