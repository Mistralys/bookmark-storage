<?php

declare(strict_types=1);

namespace BMStorage\Bookmarks;

use Application_Formable;
use Application_Formable_RecordSettings_ValueSet;
use AppUtils\RegexHelper;
use BMStorage;
use BMStorage\Crypt;
use DBHelper_BaseRecord;
use HTML_QuickForm2_Element_InputText;
use HTML_QuickForm2_Element_Textarea;

class BookmarkSettingsManager extends \Application_Formable_RecordSettings_Extended
{
    const SETTING_LABEL = 'label';
    const SETTING_URL = 'url';
    const SETTING_RATING = 'rating';

    public function __construct(Application_Formable $formable, BookmarkCollection $collection, ?BookmarkRecord $record = null)
    {
        parent::__construct($formable, $collection, $record);

        $this->setDefaultsUseStorageNames(true);
    }

    protected function processPostCreateSettings(DBHelper_BaseRecord $record, Application_Formable_RecordSettings_ValueSet $recordData, Application_Formable_RecordSettings_ValueSet $internalValues): void
    {
    }

    protected function getCreateData(Application_Formable_RecordSettings_ValueSet $recordData, Application_Formable_RecordSettings_ValueSet $internalValues): void
    {
    }

    protected function updateRecord(Application_Formable_RecordSettings_ValueSet $recordData, Application_Formable_RecordSettings_ValueSet $internalValues): void
    {
    }

    protected function registerSettings(): void
    {
        $group = $this->addGroup(t('General'))
            ->setIcon(BMStorage::icon()->bookmark());

        $group->registerSetting(self::SETTING_LABEL)
            ->setStorageName(BookmarkCollection::COL_LABEL)
            ->makeRequired()
            ->setCallback($this->injectLabel(...))
            ->setStorageFilter(array(Crypt::class, 'encode'));

        $group->registerSetting(self::SETTING_URL)
            ->setStorageName(BookmarkCollection::COL_URL)
            ->makeRequired()
            ->setCallback($this->injectUrl(...))
            ->setStorageFilter(array(Crypt::class, 'encode'));

        $group->registerSetting(self::SETTING_RATING)
            ->setDefaultValue(0)
            ->setStorageName(BookmarkCollection::COL_RATING)
            ->setCallback($this->injectRating(...));
    }

    private function injectRating() : HTML_QuickForm2_Element_InputText
    {
        $el = $this->addElementInteger(self::SETTING_RATING, t('Rating'));

        return $el;
    }

    private function injectURL() : HTML_QuickForm2_Element_Textarea
    {
        $el = $this->addElementTextarea(self::SETTING_URL, t('URL'));
        $el->setRows(2);
        $el->addClass('input-xxlarge');
        $el->addFilterTrim();

        $this->makeLengthLimited($el, 0, 8000);
        $this->addRuleRegex($el, RegexHelper::REGEX_URL, t('The URL must be valid.'));

        return $el;
    }

    private function injectLabel() : HTML_QuickForm2_Element_InputText
    {
        $el = $this->addElementText(self::SETTING_LABEL, t('Label'));
        $el->addClass('input-xxlarge');
        $el->addFilterTrim();

        $this->addRuleLabel($el);
        $this->makeLengthLimited($el, 0, 160);

        return $el;
    }

    public function getDefaultSettingName(): string
    {
        return self::SETTING_LABEL;
    }

    public function isUserAllowedEditing(): bool
    {
        return true;
    }
}
