<?php
/**
* @package BMStorage
* @subpackage Core
*/

declare(strict_types=1);

namespace BMStorage\Environments;

use Application\Environments;
use Application\Environments\EnvironmentSetup\BaseEnvironmentConfig;
use const BMStorage\Configuration\BASE_URL;
use const BMStorage\Configuration\VENDOR_URL;
use const BMStorage\Configuration\AUTH_SALT;
use const BMStorage\Configuration\REQUEST_LOG_PASSWORD;
use const BMStorage\Configuration\DB_HOST;
use const BMStorage\Configuration\DB_NAME;
use const BMStorage\Configuration\DB_USER;
use const BMStorage\Configuration\DB_PASSWORD;
use const BMStorage\Configuration\DB_PORT;
use const BMStorage\Configuration\DB_TEST_HOST;
use const BMStorage\Configuration\DB_TEST_NAME;
use const BMStorage\Configuration\DB_TEST_USER;
use const BMStorage\Configuration\DB_TEST_PASSWORD;
use const BMStorage\Configuration\DB_TEST_PORT;

/**
 * Local environment configuration.
 *
 * @package BMStorage
 * @subpackage Core
 */
class LocalEnvironment extends BaseEnvironmentConfig
{
    public function getID(): string
    {
        return EnvironmentsConfig::ENVIRONMENT_LOCAL;
    }

    public function getType(): string
    {
        return Environments::TYPE_DEV;
    }

    protected function configureCustomSettings(): void
    {
        $this->config
            ->setURL(BASE_URL)
            ->setVendorURL(VENDOR_URL)
            ->setAuthSalt(AUTH_SALT)
            ->setRequestLogPassword(REQUEST_LOG_PASSWORD)
            ->setSimulateSession(true)

            ->setDBHost(DB_HOST)
            ->setDBName(DB_NAME)
            ->setDBUser(DB_USER)
            ->setDBPassword(DB_PASSWORD)
            ->setDBPort(DB_PORT)

            ->setDBTestsHost(DB_TEST_HOST)
            ->setDBTestsName(DB_TEST_NAME)
            ->setDBTestsUser(DB_TEST_USER)
            ->setDBTestsPassword(DB_TEST_PASSWORD)
            ->setDBTestsPort(DB_TEST_PORT);
    }

    protected function setUpEnvironment(): void
    {
        $this->environment
            ->includeFile($this->configFolder.'/env-local.php');
    }
}
