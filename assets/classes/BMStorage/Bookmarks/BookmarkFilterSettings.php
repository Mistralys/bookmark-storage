<?php

declare(strict_types=1);

namespace BMStorage\Bookmarks;

use DBHelper_BaseFilterSettings;

class BookmarkFilterSettings extends DBHelper_BaseFilterSettings
{
    const SETTING_SEARCH = 'search';

    protected function registerSettings(): void
    {
        $this->registerSetting(self::SETTING_SEARCH, t('Search'));
    }

    protected function _configureFilters(): void
    {
        $this->filters->setSearch($this->getSettingString(self::SETTING_SEARCH));
    }
}
