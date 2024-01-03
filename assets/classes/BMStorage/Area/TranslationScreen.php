<?php
/**
 * @package BMStorage
 * @subpackage Administration
 * @template-version 1.1
 */

declare(strict_types=1);

namespace BMStorage\Area;

use Application_Admin_TranslationsArea;
use BMStorage;
use BMStorage_Request;
use BMStorage_Session;
use BMStorage_User;

/**
 * Displays the UI to translate the application's texts.
 *
 * @package BMStorage
 * @subpackage Administration
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 * @see Application_Admin_TranslationsArea
 *
 * @property BMStorage $driver
 * @property BMStorage_User $user
 * @property BMStorage_Session $session
 * @property BMStorage_Request $request
 */
class TranslationScreen extends Application_Admin_TranslationsArea
{
    public function isUserAllowed() : bool
    {
        return $this->user->canTranslateUI();
    }

    public function getNavigationGroup() : string
    {
        return t('Manage');
    }
}
