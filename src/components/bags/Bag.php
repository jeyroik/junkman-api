<?php
namespace junkman\components\bags;

use extas\components\players\THasPlayer;
use extas\components\THasId;
use junkman\interfaces\bags\IBag;

/**
 * Class Bag
 *
 * @package junkman\components\bags
 * @author jeyroik@gmail.com
 */
class Bag extends BagSample implements IBag
{
    use THasId;
    use THasPlayer;
}
