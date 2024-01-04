/**
* UI Icon handling class: offers an easy-to-use API
* to create icons for common application tasks.
*
* @package BMStorage
* @subpackage User Interface
* @author Sebastian Mordziol <s.mordziol@mistralys.eu>
* @class
*
* @template-version 1
*/
var CustomIcon =
{
    // region: Icon methods
    
    Bookmark:function() { return this.SetType('bookmark', 'fas'); },
    ExternalUrl:function() { return this.SetType('external-link-alt', 'fas'); },

    // endregion
};

CustomIcon = UI_Icon.extend(CustomIcon);
