<?php
/**
* @package BMStorage
* @subpackage Core
*/

declare(strict_types=1);

namespace BMStorage\Environments;

use Application\ConfigSettings\BaseConfigRegistry;
use Application\Environments\BaseEnvironmentsConfig;
use Application\Environments\Environment;
use const BMStorage\Configuration\COMPANY_NAME;
use const BMStorage\Configuration\CONTENT_LOCALES;
use const BMStorage\Configuration\UI_LOCALES;
use const BMStorage\Configuration\SAMPLE_EMAIL;
use const BMStorage\Configuration\SYSTEM_EMAIL;
use const BMStorage\Configuration\SYSTEM_NAME;
use const BMStorage\Configuration\SIMULATE_SESSION;
use const BMStorage\Configuration\JAVASCRIPT_MINIFIED;
use const BMStorage\Configuration\SHOW_QUERIES;
use const BMStorage\Configuration\TRACK_QUERIES;
use const BMStorage\Configuration\LOGGING_ENABLED;

/**
 * Global application environments registry and
 * common settings for all environments.
 *
 * @package BMStorage
 * @subpackage Core
 */
class EnvironmentsConfig extends BaseEnvironmentsConfig
{
    public const ENVIRONMENT_LOCAL = 'local';
    public const ENVIRONMENT_LIVE = 'live';

    protected function getClassName(): string
    {
        return 'BMStorage';
    }

    protected function getCompanyName(): string
    {
        return COMPANY_NAME;
    }

    protected function getDummyEmail(): string
    {
        return SAMPLE_EMAIL;
    }

    protected function getSystemEmail(): string
    {
        return SYSTEM_EMAIL;
    }

    protected function getSystemName(): string
    {
        return SYSTEM_NAME;
    }

    protected function getContentLocales(): array
    {
        return CONTENT_LOCALES;
    }

    protected function getUILocales(): array
    {
        return UI_LOCALES;
    }

    protected function createCustomSettings(): BaseConfigRegistry
    {
        return new ConfigRegistry();
    }

    protected function configureDefaultSettings(Environment $environment): void
    {
        $this->config
            ->setInstanceID('')
            ->setSimulateSession(SIMULATE_SESSION)
            ->setLoggingEnabled(LOGGING_ENABLED)
            ->setJavascriptMinified(JAVASCRIPT_MINIFIED)
            ->setShowQueries(SHOW_QUERIES)
            ->setTrackQueries(TRACK_QUERIES);

        $environment
            ->includeFile($this->configFolder.'/hosts.php');
    }

    protected function getRequiredSettingNames(): array
    {
        return array();
    }

    public function getDefaultEnvironmentID(): string
    {
        return self::ENVIRONMENT_LOCAL;
    }

    protected function getEnvironmentClasses(): array
    {
        return array(
            LocalEnvironment::class,
        );
    }
}
