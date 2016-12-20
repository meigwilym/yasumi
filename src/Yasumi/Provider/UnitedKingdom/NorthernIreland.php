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
 * Provider for all holidays in Northern Ireland (United Kingdom).
 *
 * @link https://en.wikipedia.org/wiki/Northern_Ireland
 */
class NorthernIreland extends UnitedKingdom
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'GB-NIR';

    /**
     * Initialize holidays for NorthernIreland (United Kingdom).
     */
    public function initialize()
    {
        parent::initialize();

        $this->calculateStPatricksDay();
        $this->calculateBattleoftheBoyne();
    }

    /**
     * St Patrick's Day
     * @link https://en.wikipedia.org/wiki/Saint_Patrick's_Day#Ireland
     * @return void
     */
    public function calculateStPatricksDay()
    {
        if($this->year < 1903)
        {
            return;
        }

        $stPatricks = new \DateTime("$this->year-07-12", new DateTimeZone($this->timezone));

        switch ($stPatricks->format('w')) {
            case 6:
                $stPatricks->add(new DateInterval('P2D'));
                break;
            case 0:
                $stPatricks->add(new DateInterval('P1D'));
                break;
        }

        $this->addHoliday(new Holiday('stPatricksDay', [], $stPatricks, $this->locale, Holiday::TYPE_BANK));
    }

    /**
     * Battle of The Boyne/Orangemen's Day
     *
     * @link https://www.timeanddate.com/holidays/uk/orangemen-day
     * @return void
     */
    public function calculateBattleoftheBoyne()
    {
        $boyne = new \DateTime("$this->year-07-12", new DateTimeZone($this->timezone));

        switch ($boyne->format('w')) {
            case 6:
                $boyne->add(new DateInterval('P2D'));
                break;
            case 0:
                $boyne->add(new DateInterval('P1D'));
                break;
        }

        $this->addHoliday(new Holiday('battleOfTheBoyne', [], $boyne, $this->locale, Holiday::TYPE_BANK));
    }
}