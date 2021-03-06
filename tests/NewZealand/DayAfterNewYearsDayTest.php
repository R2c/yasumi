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

namespace Yasumi\tests\NewZealand;

use DateTime;
use DateTimeZone;
use DateInterval;

/**
 * Class for testing Day After New Years Day in the New Zealand.
 */
class DayAfterNewYearsDayTest extends NewZealandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'dayAfterNewYearsDay';

    /**
     * Tests Day After New Years Day
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int $year the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     */
    public function testHoliday($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime($expected, new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1921),
            ['en_US' => 'Day after New Year\'s Day']
        );
    }

    /**
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider()
    {
        $data = [];

        for ($y = 0; $y < 50; $y ++) {
            $year = $this->generateRandomYear(1800, 2100);
            $date = new DateTime("$year-01-02", new DateTimeZone(self::TIMEZONE));

            switch ($date->format('w')) {
                case 0:
                case 6:
                    $date->add(new DateInterval('P2D'));
                    break;
                case 1:
                    $date->add(new DateInterval('P1D'));
            }

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }
}
