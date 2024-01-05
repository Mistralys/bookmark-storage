<?php

declare(strict_types=1);

namespace BMStorage\Bookmarks;

use DBHelper_BaseFilterSettings;

/**
 * @property BookmarkCriteria $filters
 */
class BookmarkFilterSettings extends DBHelper_BaseFilterSettings
{
    const SETTING_SEARCH = 'search';
    const SETTING_RATING_FROM = 'rating_from';
    const SETTING_RATING_TO = 'rating_to';

    protected function registerSettings(): void
    {
        $this->registerSetting(self::SETTING_SEARCH, t('Search'));
        $this->registerSetting(self::SETTING_RATING_FROM, t('From rating'));
        $this->registerSetting(self::SETTING_RATING_TO, t('To rating'));
    }

    public function inject_rating_from() : void
    {
        $el = $this->addElementText(self::SETTING_RATING_FROM);
        $el->addFilterTrim();

        $this->form->addRuleInteger($el, 0, 6);
    }

    public function inject_rating_to() : void
    {
        $el = $this->addElementText(self::SETTING_RATING_TO);
        $el->addFilterTrim();

        $this->form->addRuleInteger($el, 0, 6);
    }

    protected function _configureFilters(): void
    {
        $this->filters->setSearch($this->getSettingString(self::SETTING_SEARCH));

        $this->configureRating();
    }

    private function configureRating() : void
    {
        $from = $this->getSettingInt(self::SETTING_RATING_FROM);
        if($from > 0) {
            $this->filters->selectRatingFrom($from);
        }

        $to = $this->getSettingInt(self::SETTING_RATING_TO);
        if($to > 0) {
            $this->filters->selectRatingTo($to);
        }
    }
}
