<?php
/**
* File containing the {@see BMStorage\CustomIcon} class.
*
* @package BMStorage
* @subpackage User Interface
* @see BMStorage\CustomIcon
*
* @template-version 1
*/

declare(strict_types=1);

namespace BMStorage;

use UI_Icon;

/**
* Custom icon class for application-specific icons. Extends
* the framework's icon class, so has the capability to both
* overwrite existing icons and to add new ones.
*
* @package BMStorage
* @subpackage User Interface
* @author Sebastian Mordziol <s.mordziol@mistralys.eu>
* @see UI_Icon
*/
class CustomIcon extends UI_Icon
{
    // region: Icon type methods
    
    /**
     * @return $this
     */
    public function bookmark() : self { return $this->setType('bookmark', 'fas'); }
    /**
     * @return $this
     */
    public function externalUrl() : self { return $this->setType('external-link-alt', 'fas'); }
    
    // endregion
}
