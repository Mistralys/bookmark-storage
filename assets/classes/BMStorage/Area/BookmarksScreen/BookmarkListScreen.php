<?php

declare(strict_types=1);

namespace BMStorage\Area\BookmarksScreen;

use Application_Admin_Area_Mode_CollectionList;
use AppUtils\ClassHelper;
use AppUtils\ConvertHelper;
use BMStorage;
use BMStorage\Bookmarks\BookmarkCollection;
use BMStorage\Bookmarks\BookmarkRecord;
use BMStorage\ClassFactory;
use DBHelper_BaseFilterCriteria_Record;
use DBHelper_BaseRecord;

class BookmarkListScreen extends Application_Admin_Area_Mode_CollectionList
{
    public const URL_NAME = 'list';
    public const COL_LABEL = 'label';
    const COL_DOMAIN = 'domain';
    const COL_CREATED = 'created';
    const COL_RATING = 'rating';

    public function getURLName(): string
    {
        return self::URL_NAME;
    }

    protected function createCollection(): BookmarkCollection
    {
        return ClassFactory::createBookmarks();
    }

    protected function getEntryData(DBHelper_BaseRecord $record, DBHelper_BaseFilterCriteria_Record $entry)
    {
        $bookmark = ClassHelper::requireObjectInstanceOf(
            BookmarkRecord::class,
            $record
        );

        return array(
            self::COL_LABEL => sb()
                ->add($bookmark->getLabelLinked())
                ->add(' | ')
                ->link((string)BMStorage::icon()->externalUrl(), $bookmark->getURL()),
            self::COL_DOMAIN => $bookmark->getDomain(),
            self::COL_RATING => $bookmark->getRating(),
            self::COL_CREATED => ConvertHelper::date2listLabel($bookmark->getDateCreated(), true, true)
        );
    }

    protected function configureColumns(): void
    {
        $this->grid->addColumn(self::COL_LABEL, t('Label'))
            ->setSortable(true, BookmarkCollection::COL_LABEL);

        $this->grid->addColumn(self::COL_DOMAIN, t('Domain'))
            ->setSortable(false, BookmarkCollection::COL_DOMAIN);

        $this->grid->addColumn(self::COL_RATING, t('Rating'))
            ->setSortable(true, BookmarkCollection::COL_RATING);

        $this->grid->addColumn(self::COL_CREATED, t('Created'))
            ->setSortable(true, BookmarkCollection::COL_DATE_CREATED);
    }

    protected function configureActions(): void
    {
    }

    public function getBackOrCancelURL(): string
    {
        return $this->createCollection()->getAdminURL();
    }

    public function isUserAllowed(): bool
    {
        return true;
    }

    public function getNavigationTitle(): string
    {
        return t('List');
    }

    public function getTitle(): string
    {
        return t('Available bookmarks');
    }

    protected function _handleSidebar(): void
    {
        $this->sidebar->addButton('create-bookmark', t('Create new...'))
            ->setIcon(BMStorage::icon()->add())
            ->makeLinked($this->createCollection()->getAdminCreateURL())
            ->makePrimary();

        $this->sidebar->addSeparator();

        parent::_handleSidebar();
    }
}
