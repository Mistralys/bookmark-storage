<?php
/**
 * Initializes the environment detection and loads appropriate
 * configuration files.
 *
 * Include in versioning: YES
 * Requires adjustments: NO
 *
 * @package BMStorage
 * @subpackage Configuration
 * @template-version 1
 */

declare(strict_types=1);

namespace BMStorage\Configuration;

use Application\Environments;
use AppUtils\FileHelper\FolderInfo;
use BMStorage\Environments\EnvironmentsConfig;
use Throwable;

if(!function_exists('boot_define'))
{
    die('May not be accessed directly.');
}

try
{
    (new EnvironmentsConfig(FolderInfo::factory(__DIR__)))
        ->detect();
}
catch (Throwable $e)
{
    if(isset($_REQUEST['simulate_only']) && $_REQUEST['simulate_only'] === 'yes') {
        Environments::displayException($e);
    }

    die('Exception #'.$e->getCode().': '.$e->getMessage());
}
