<?php

declare(strict_types=1);

namespace BMStorage\Area;

use Application_Admin_Area;
use BMStorage\Area\BookmarksScreen\BookmarkListScreen;

class BookmarksScreen extends Application_Admin_Area
{
    public const URL_NAME = 'bookmarks';

    public function getURLName(): string
    {
        return self::URL_NAME;
    }

    public function getDefaultMode(): string
    {
        return BookmarkListScreen::URL_NAME;
    }

    public function getNavigationGroup(): string
    {
        return '';
    }

    public function isUserAllowed(): bool
    {
        return true;
    }

    public function getDependencies(): array
    {
        return array();
    }

    public function isCore(): bool
    {
        return true;
    }

    protected function _handleBreadcrumb(): void
    {
        $this->breadcrumb->appendArea($this);
    }

    public function getNavigationTitle(): string
    {
        return t('Bookmarks');
    }

    public function getTitle(): string
    {
        return t('Bookmarks');
    }
}
