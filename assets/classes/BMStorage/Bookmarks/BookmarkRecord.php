<?php

declare(strict_types=1);

namespace BMStorage\Bookmarks;

use BMStorage\Crypt;
use DateTime;
use DBHelper_BaseRecord;

class BookmarkRecord extends DBHelper_BaseRecord
{
    public function getLabel(): string
    {
        return Crypt::decode($this->getRecordStringKey(BookmarkCollection::COL_LABEL));
    }

    public function getLabelLinked() : string
    {
        return $this->getLabel();
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
}
