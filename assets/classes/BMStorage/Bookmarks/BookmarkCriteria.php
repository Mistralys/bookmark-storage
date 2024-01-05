<?php

declare(strict_types=1);

namespace BMStorage\Bookmarks;

use DBHelper_BaseFilterCriteria;
use DBHelper_StatementBuilder_ValuesContainer;

class BookmarkCriteria extends DBHelper_BaseFilterCriteria
{
    private int $ratingFrom = 0;
    private int $ratingTo = 0;

    public function selectRatingFrom(int $from) : self
    {
        $this->ratingFrom = $from;
        return $this;
    }

    public function selectRatingTo(int $to) : self
    {
        $this->ratingTo = $to;
        return $this;
    }

    protected function prepareQuery(): void
    {
        if($this->ratingTo > 0) {
            $this->addWhere($this->statement(sprintf('{bm_rating} <= %s', $this->ratingTo)));
        }

        if($this->ratingFrom > 0) {
            $this->addWhere($this->statement(sprintf('{bm_rating} >= %s', $this->ratingFrom)));
        }
    }

    protected function _registerJoins(): void
    {
    }

    protected function _registerStatementValues(DBHelper_StatementBuilder_ValuesContainer $container): void
    {
        $container
            ->field('{bm_rating}', BookmarkCollection::COL_RATING);
    }
}
