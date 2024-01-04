<?php

declare(strict_types=1);

namespace BMStorage\Area\BookmarksScreen;

use Application_Admin_Area_Mode_CollectionCreate;
use Application_Formable_RecordSettings;
use BMStorage\Bookmarks\BookmarkCollection;
use BMStorage\ClassFactory;
use DBHelper_BaseRecord;

class CreateBookmarkScreen extends Application_Admin_Area_Mode_CollectionCreate
{
    public const URL_NAME = 'create';

    public function getURLName(): string
    {
        return self::URL_NAME;
    }

    public function createCollection() : BookmarkCollection
    {
        return ClassFactory::createBookmarks();
    }

    public function getSuccessMessage(DBHelper_BaseRecord $record): string
    {
        return t(
            'The bookmark %1$s has been created successfully at %2$s.',
            $record->getLabel(),
            sb()->time()
        );
    }

    /**
     * @return Application_Formable_RecordSettings|NULL
     */
    public function getSettingsManager(): ?Application_Formable_RecordSettings
    {
        return $this->createCollection()->createSettingsManager($this);
    }

    public function getBackOrCancelURL(): string
    {
        return $this->createCollection()->getAdminListURL();
    }

    public function isUserAllowed(): bool
    {
        return true;
    }

    public function getTitle(): string
    {
        return t('Create a bookmark');
    }
}
