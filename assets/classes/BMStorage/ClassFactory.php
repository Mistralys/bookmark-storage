<?php

declare(strict_types=1);

namespace BMStorage;

use Application\AppFactory;
use BMStorage\Bookmarks\BookmarkCollection;

class ClassFactory extends AppFactory
{
    public static function createBookmarks() : BookmarkCollection
    {
        return self::createClassInstance(BookmarkCollection::class);
    }
}
