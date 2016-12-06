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
namespace Yasumi\tests\Taiwan;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class to test 228 Peace Memorial Day.
 */
class PeaceMemorialDayTest extends TaiwanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday.
     */
    const HOLIDAY = '228PeaceMemorialDay';

    /**
     * The year in which the holiday was first established.
     */
    const ESTABLISHMENT_YEAR = 1995;

    /**
     * Tests the holiday defined in this test.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int      $year     the year for which the holiday defined in this test needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testHoliday($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of the holiday defined in this test.
     *
     * @return array list of test dates for the holiday defined in this test.
     */
    public function HolidayDataProvider()
    {
        $data = [];

        for ($y = 0; $y < 50; ++$y) {
            $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
            $date = new DateTime($year . '-2-28', new DateTimeZone(self::TIMEZONE));

            /* When the memorial day or holiday falls on a Saturday or Sunday, a deferred day off will be granted.
             * If a memorial day or a holiday falls on a Saturday, the deferred day off is on the preceding workday; 
             * if a memorial day or a holiday falls on a Sunday, the deferred day off is on he following workday.
             */
            if (in_array($date->format('w'), [0])) {
                $date->sub(new DateInterval('P1D'));
            }

            if (in_array($date->format('w'), [6])) {
                $date->add(new DateInterval('P1D'));
            }

            $data[] = [$year, $date];
        }

        return $data;
    }

    /**
     * Tests the holiday defined in this test before establishment.
     */
    public function testHolidayBeforeEstablishment()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }

    /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR), [self::LOCALE => '228和平紀念日']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_NATIONAL);
    }
}
