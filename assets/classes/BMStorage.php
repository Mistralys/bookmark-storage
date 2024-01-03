<?php
/**
 * @package BMStorage
 * @subpackage Core
 * @template-version 1.2
 */

declare(strict_types=1);

use AppUtils\FileHelper\FileInfo;
use BMStorage\Area\DevelScreen;
use BMStorage\Area\TranslationScreen;
use BMStorage\Area\SettingScreen;

/**
 * Main driver class for the application.
 *
 * @package BMStorage
 * @subpackage Core
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 * @see Application_Driver
 * 
 * @property BMStorage_User $user
 * @property BMStorage_Session $session
 * @property BMStorage_Request $request
 */
class BMStorage extends Application_Driver
{
    public function getPageParams(UI_Page $page) : array
    {
        return array();
    }
    
    protected function setUpUI() : void
    {
        $this->configureAdminUIFramework();
        
        $this->ui->addJavascriptHeadVariable('application.instanceID', APP_INSTANCE_ID);
    }
    
    public function getAppName() : string
    {
        return t('Bookmark Storage');
    }
    
    public function getAppNameShort() : string
    {
        return t('Bookmark Storage');
    }
    
    public function getAdminAreas() : array
    {
        return array(
            Application_Admin_Area_Settings::URL_NAME => getClassTypeName(SettingScreen::class),
            Application_Admin_TranslationsArea::URL_NAME => getClassTypeName(TranslationScreen::class),
            Application_Admin_Area_Devel::URL_NAME => getClassTypeName(DevelScreen::class),
        );
    }

    public function areaExists(string $name): bool
    {
        $areas = $this->getAdminAreas();
        return isset($areas[$name]) || in_array($name, $areas, true);
    }
    
    public function getRevisionableTypes()
    {
        return array();
    }
    
    protected static ?BMStorage_Session $session = null;
    
    public static function getSession() : BMStorage_Session
    {
        if(!isset(self::$session)) {
            self::$session = new BMStorage_Session();
        }
        
        return self::$session;
    }
    
    protected ?string $extendedVersion = null;
    
    public function getExtendedVersion() : string
    {
        if(!isset($this->extendedVersion)) {
            $this->extendedVersion = FileInfo::factory(APP_ROOT.'/version')->getContents();
        }
        
        return $this->extendedVersion;
    }
}
