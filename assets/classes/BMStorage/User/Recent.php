<?php
/**
 * File containing the {@see BMStorage_User_Recent} class.
 * 
 * @package BMStorage
 * @subpackage Core
 * @see BMStorage_User_Recent
 */

declare(strict_types=1);

/**
 * Class for an authenticated user's recent items handling.
 *
 * @package BMStorage
 * @subpackage Core
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 * @see Application_User_Recent
 *
 * @template-version 1
 */
class BMStorage_User_Recent extends Application_User_Recent
{
    protected function registerCategories() : void
    {
    }
}
