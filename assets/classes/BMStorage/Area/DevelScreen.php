<?php
/**
 * @package BMStorage
 * @subpackage Administration
 * @template-version 1.2
 */

declare(strict_types=1);

namespace BMStorage\Area;

use Application_Admin_Area_Devel;
use BMStorage;
use BMStorage_Request;
use BMStorage_Session;
use BMStorage_User;

/**
 * The main developer tools area.
 *
 * @package BMStorage
 * @subpackage Administration
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 * @see Application_Admin_Area_Devel
 *
 * @property BMStorage $driver
 * @property BMStorage_User $user
 * @property BMStorage_Session $session
 * @property BMStorage_Request $request
 */
class DevelScreen extends Application_Admin_Area_Devel
{
	protected function initItems() : void
    {
        $this->registerMaintenance();
        $this->registerAppSettings();
        $this->registerAppInterface();
        $this->registerAppSets();
        $this->registerErrorLog();
        $this->registerAppLogs();
        $this->registerDBDumps();
        $this->registerRightsOverview();

        // register custom items
        //$this->registerItem('urlname', t('Label'), t('Category name'));
    }
}
