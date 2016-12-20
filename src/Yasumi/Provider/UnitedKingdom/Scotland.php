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

use Yasumi\Holiday;
use Yasumi\Provider\UnitedKingdom;

/**
 * Provider for all holidays in Scotland (United Kingdom).
 *
 * @link https://en.wikipedia.org/wiki/Scotland
 */
class Scotland extends UnitedKingdom
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'GB-SCT';

    /**
     * Initialize holidays for Scotland (United Kingdom).
     */
    public function initialize()
    {
        parent::initialize();

        $this->calculcateStAndrewsDay();
    }

    /**
     * St Andrew's Day
     *
     * @link https://en.wikipedia.org/wiki/St_Andrew%27s_Day_Bank_Holiday_(Scotland)_Act_2007
     * @return void
     */
    public function calculcateStAndrewsDay()
    {
        if($this->year < 2007)
        {
            return;
        }
        
        $stAndrewsDay = new \DateTime("$this->year-11-30", new DateTimeZone($this->timezone));

        switch ($stAndrewsDay->format('w')) {
            case 6:
                $stAndrewsDay->add(new DateInterval('P2D'));
                break;
            case 0:
                $stAndrewsDay->add(new DateInterval('P1D'));
                break;
        }

        $this->addHoliday(new Holiday('stAndrewsDay', [], $stAndrewsDay, $this->locale, Holiday::TYPE_BANK));
    }
}