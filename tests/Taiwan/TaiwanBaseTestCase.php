<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\tests\Taiwan;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Taiwan holiday provider.
 */
abstract class TaiwanBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested.
     */
    const REGION = 'Taiwan';

    /**
     * Timezone in which this provider has holidays defined.
     */
    const TIMEZONE = 'Asia/Taipei';

    /**
     * Locale that is considered common for this provider.
     */
    const LOCALE = 'zh_Hant_TW';
}
