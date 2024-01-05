<?php

declare(strict_types=1);

namespace BMStorage\Area\BookmarksScreen\ViewBookmarkScreen;

use Application_Admin_Area_Mode_Submode_CollectionEdit;
use Application_Formable_RecordSettings;
use BMStorage\Bookmarks\BookmarkCollection;
use BMStorage\Bookmarks\BookmarkRecord;
use BMStorage\ClassFactory;
use BMStorage\Crypt;
use DBHelper_BaseRecord;

/**
 * @property BookmarkRecord $record
 */
class BookmarkSettingsScreen extends Application_Admin_Area_Mode_Submode_CollectionEdit
{
    public const URL_NAME = 'bookmark-settings';

    public function getURLName(): string
    {
        return self::URL_NAME;
    }

    public function getDefaultAction(): string
    {
        return '';
    }

    public function isUserAllowedEditing(): bool
    {
        return true;
    }

    public function isEditable(): bool
    {
        return true;
    }

    public function createCollection() : BookmarkCollection
    {
        return ClassFactory::createBookmarks();
    }

    public function getSuccessMessage(DBHelper_BaseRecord $record): string
    {
        return t(
            'The bookmark settings have been saved successfully at %1$s.',
            sb()->time()
        );
    }

    public function getSettingsManager(): ?Application_Formable_RecordSettings
    {
        return $this->createCollection()->createSettingsManager($this, $this->record);
    }

    public function getBackOrCancelURL(): string
    {
        return $this->createCollection()->getAdminListURL();
    }

    public function getDefaultFormValues(): array
    {
        $values = parent::getDefaultFormValues();

        foreach($values as $name => $value) {
            if(is_string($value)) {
                $values[$name] = Crypt::decode($value);
            }
        }

        return $values;
    }

    public function getTitle(): string
    {
        return t('Edit bookmark settings');
    }
}