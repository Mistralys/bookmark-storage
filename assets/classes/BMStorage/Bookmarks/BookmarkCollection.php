<?php

declare(strict_types=1);

namespace BMStorage\Bookmarks;

use Application_Admin_ScreenInterface;
use Application_Formable;
use AppUtils\Microtime;
use BMStorage\Area\BookmarksScreen;
use BMStorage\Area\BookmarksScreen\BookmarkListScreen;
use BMStorage\Area\BookmarksScreen\CreateBookmarkScreen;
use BMStorage\ClassFactory;
use BMStorage\Crypt;
use DBHelper_BaseCollection;
use DBHelper_BaseCollection_Keys_Key;
use function AppUtils\parseURL;

class BookmarkCollection extends DBHelper_BaseCollection
{
    public const TABLE_NAME = 'bookmarks';
    public const PRIMARY_NAME = 'bookmark_id';
    public const COL_LABEL = 'label';
    public const COL_URL = 'url';
    public const COL_RATING = 'rating';
    public const COL_DATE_CREATED = 'date_created';
    public const COL_DOMAIN = 'domain';

    public function getRecordClassName(): string
    {
        return BookmarkRecord::class;
    }

    public function getRecordFiltersClassName(): string
    {
        return BookmarkCriteria::class;
    }

    public function getRecordFilterSettingsClassName(): string
    {
        return BookmarkFilterSettings::class;
    }

    public function getRecordDefaultSortKey(): string
    {
        return self::COL_LABEL;
    }

    public function getRecordSearchableColumns(): array
    {
        return array(
            self::COL_LABEL => t('Label'),
            self::COL_DOMAIN => t('Domain name')
        );
    }

    public function getRecordTableName(): string
    {
        return self::TABLE_NAME;
    }

    public function getRecordPrimaryName(): string
    {
        return self::PRIMARY_NAME;
    }

    public function getRecordTypeName(): string
    {
        return 'bookmark';
    }

    public function getCollectionLabel(): string
    {
        return t('Bookmarks');
    }

    public function getRecordLabel(): string
    {
        return t('Bookmark');
    }

    public function getRecordProperties(): array
    {
        return array();
    }

    public function getAdminURL(array $params=array()) : string
    {
        $params[Application_Admin_ScreenInterface::REQUEST_PARAM_PAGE] = BookmarksScreen::URL_NAME;

        return ClassFactory::createRequest()
            ->buildURL($params);
    }

    public function getAdminListURL(array $params=array()) : string
    {
        $params[Application_Admin_ScreenInterface::REQUEST_PARAM_MODE] = BookmarkListScreen::URL_NAME;

        return $this->getAdminURL($params);
    }

    public function createSettingsManager(Application_Formable $formable, ?BookmarkRecord $record = null): BookmarkSettingsManager
    {
        return new BookmarkSettingsManager($formable, $this, $record);
    }

    public function getAdminCreateURL(array $params=array()) : string
    {
        $params[Application_Admin_ScreenInterface::REQUEST_PARAM_MODE] = CreateBookmarkScreen::URL_NAME;

        return $this->getAdminURL($params);
    }

    protected function _registerKeys(): void
    {
        $this->keys->register(self::COL_LABEL)
            ->makeRequired();

        $this->keys->register(self::COL_URL)
            ->makeRequired();

        $this->keys->register(self::COL_DATE_CREATED)
            ->makeRequired()
            ->setGenerator(function () {
                return Microtime::createNow()->getMySQLDate();
            });

        $this->keys->register(self::COL_RATING)
            ->makeRequired()
            ->setDefault('0');

        $this->keys->register(self::COL_DOMAIN)
            ->makeRequired()
            ->setGenerator(function (DBHelper_BaseCollection_Keys_Key $key, array $data) : string {
                $info = parseURL(Crypt::decode($data[self::COL_URL]));
                return Crypt::encode($info->getHost());
            });
    }
}
