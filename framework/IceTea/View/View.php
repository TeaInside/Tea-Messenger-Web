<?php

namespace IceTea\View;

class View
{
    public static function buildView($name, $variables)
    {
        return new ViewSkeleton($name, $variables);
    }

    public static function make(ViewSkeleton $skeleton)
    {
        $cache = new CacheHandler($skeleton);
        if (! $cache->isCached() && ! $cache->isPerfectCache()) {
            $cache->makeCache();
        }

        return include $cache->getCacheFileName();
    }
}
