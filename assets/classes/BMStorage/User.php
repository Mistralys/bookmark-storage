<?php
/**
 * File containing the {@see BMStorage_User} class.
 * 
 * @package BMStorage
 * @subpackage Core
 * @see BMStorage_User
 */

declare(strict_types=1);

/**
 * Class for an authenticated user.
 *
 * @package BMStorage
 * @subpackage Core
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 * @see Application_User
 *
 * @template-version 1.2
 */
class BMStorage_User extends Application_User_Extended
{
    public function getRightGroups(): array
    {
        return array();
    }

    protected function registerRoles(): void
    {

    }
}
