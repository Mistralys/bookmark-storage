<?php
/**
 * @package BMStorage
 * @subpackage Administration
 * @template-version 1.2
 */
 
declare(strict_types=1);

namespace BMStorage\Area;

use Application_Admin_Area_Settings;
use BMStorage;
use BMStorage_Request;
use BMStorage_Session;
use BMStorage_User;

/**
 * The user settings screen where the user can change his preferences.
 *
 * @package BMStorage
 * @subpackage Administration
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 * @see Application_Admin_Area_Settings
 *
 * @property BMStorage $driver
 * @property BMStorage_User $user
 * @property BMStorage_Session $session
 * @property BMStorage_Request $request
 */
class SettingScreen extends Application_Admin_Area_Settings
{
    public function getNavigationGroup() : string
    {
        return t('Manage');
    }
}
