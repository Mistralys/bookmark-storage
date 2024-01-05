<?php

declare(strict_types=1);

namespace BMStorage\Bookmarks;

use Application_Admin_ScreenInterface;
use BMStorage\Area\BookmarksScreen\ViewBookmarkScreen;
use BMStorage\Area\BookmarksScreen\ViewBookmarkScreen\BookmarkSettingsScreen;
use BMStorage\Crypt;
use DateTime;
use DBHelper_BaseRecord;

/**
 * @property BookmarkCollection $collection
 */
class BookmarkRecord extends DBHelper_BaseRecord
{
    public function getLabel(): string
    {
        return Crypt::decode($this->getRecordStringKey(BookmarkCollection::COL_LABEL));
    }

    public function getLabelLinked() : string
    {
        return (string)sb()->link($this->getLabel(), $this->getAdminURL());
    }

    public function getDomain(): string
    {
        return Crypt::decode($this->getRecordStringKey(BookmarkCollection::COL_DOMAIN));
    }

    public function getURL(): string
    {
        return Crypt::decode($this->getRecordStringKey(BookmarkCollection::COL_URL));
    }

    public function getRating() : int
    {
        return $this->getRecordIntKey(BookmarkCollection::COL_RATING);
    }

    public function getDateCreated() : DateTime
    {
        return $this->getRecordDateKey(BookmarkCollection::COL_DATE_CREATED);
    }

    protected function recordRegisteredKeyModified($name, $label, $isStructural, $oldValue, $newValue)
    {
    }

    public function getAdminURL(array $params=array()) : string
    {
        $params[Application_Admin_ScreenInterface::REQUEST_PARAM_MODE] = ViewBookmarkScreen::URL_NAME;
        $params[BookmarkCollection::PRIMARY_NAME] = $this->getID();

        return $this->collection->getAdminURL($params);
    }

    public function getAdminSettingsURL(array $params=array()) : string
    {
        $params[Application_Admin_ScreenInterface::REQUEST_PARAM_SUBMODE] = BookmarkSettingsScreen::URL_NAME;

        return $this->getAdminURL($params);
    }
}
