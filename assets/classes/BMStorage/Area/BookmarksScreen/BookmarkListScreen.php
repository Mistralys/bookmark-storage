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
use UI_DataGrid_Action;

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
        $this->grid->addAction('delete-bookmarks', t('Delete...'))
            ->makeDangerous()
            ->setIcon(BMStorage::icon()->delete())
            ->setCallback($this->multiDeleteBookmarks(...))
            ->makeConfirm(sb()
                ->para(sb()
                    ->bold(t('This will delete the selected bookmarks.'))
                )
                ->para(sb()
                    ->cannotBeUndone()
                )
            );
    }

    private function multiDeleteBookmarks(UI_DataGrid_Action $action) : void
    {
        $collection = $this->createCollection();

        $action->createRedirectMessage($collection->getAdminListURL())
            ->single(t('The bookmark %1$s has been deleted at %2$s.', '$label', '$time'))
            ->none(t('No bookmarks selected that could be deleted.'))
            ->multiple(t('%1$s bookmarks have been deleted at %2$s.', '$amount', '$time'))
            ->processDeleteDBRecords($collection)
            ->redirect();
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

    protected function _handleHelp(): void
    {
        $this->renderer
            ->getTitle()
            ->setIcon(BMStorage::icon()->bookmark());
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
