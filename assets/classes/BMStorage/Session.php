<?php
/**
 * File containing the {@see BMStorage_Session} class.
 *
 * @package BMStorage
 * @subpackage Core
 * @template-version 1.2
 *
 * @see BMStorage_Session
 */

declare(strict_types=1);

/**
 * Session handling class, based on the native PHP sessions.
 *
 * @package BMStorage
 * @subpackage Core
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 * @see Application_Session_Native
 */
class BMStorage_Session extends Application_Session_Native implements Application_Session_AuthTypes_NoneInterface
{
    use Application_Session_AuthTypes_None;

    public function getPrefix(): string
    {
        return 'bmstorage';
    }
}
