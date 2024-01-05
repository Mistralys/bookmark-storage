<?php

declare(strict_types=1);

namespace BMStorage\Area\BookmarksScreen;

use Application_Admin_Area_Mode_CollectionRecord;
use BMStorage;
use BMStorage\Area\BookmarksScreen\ViewBookmarkScreen\BookmarkSettingsScreen;
use BMStorage\Bookmarks\BookmarkCollection;
use BMStorage\ClassFactory;

class ViewBookmarkScreen extends Application_Admin_Area_Mode_CollectionRecord
{
    public const URL_NAME = 'view-bookmark';

    public function getURLName(): string
    {
        return self::URL_NAME;
    }

    public function getDefaultSubmode(): string
    {
        return BookmarkSettingsScreen::URL_NAME;
    }

    public function isUserAllowed(): bool
    {
        return true;
    }

    public function getNavigationTitle(): string
    {
        return t('View');
    }

    public function getTitle(): string
    {
        return t('View a bookmark');
    }

    protected function _handleHelp(): void
    {
        $this->renderer
            ->getTitle()
            ->setIcon(BMStorage::icon()->bookmark());
    }

    protected function _handleBreadcrumb(): void
    {
        $this->breadcrumb->appendItem($this->record->getLabel())
            ->makeLinked($this->record->getAdminURL());
    }

    protected function createCollection() : BookmarkCollection
    {
        return ClassFactory::createBookmarks();
    }

    protected function getRecordMissingURL(): string
    {
        return $this->createCollection()->getAdminURL();
    }
}
