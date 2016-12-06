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
 * Class containing tests for International Workers' Day (i.e. Labour Day) in Taiwan.
 */
class InternationalWorkersDayTest extends TaiwanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday.
     */
    const HOLIDAY = 'internationalWorkersDay';

    /**
     * Tests International Workers' Day.
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
            $year = $this->generateRandomYear();
            $date = new DateTime($year . '-5-1', new DateTimeZone(self::TIMEZONE));

            // If the holidays falls into the weekend, it is observed the next working day.
            if (in_array($date->format('w'), [0, 6])) {
                $date->add(new DateInterval('P2D'));
            }

            $data[] = [$year, $date];
        }

        return $data;
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => '国际劳动节']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_NATIONAL);
    }
}
