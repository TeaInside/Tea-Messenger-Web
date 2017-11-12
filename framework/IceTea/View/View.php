<?php

namespace IceTea\View;

final class View
{

    public static function make(ViewSkeleton $instance)
    {
        $cache = new CacheHandler($instance->getFileName(), $selfHash = $instance->getSelfHash());
        if ($cache->isCached() && $cache->isPerfectCache()) {
            return include basepath("storage/framework/views/" . $selfHash . ".php");            
        } else {
            $instance->buildBody();
            $cache->makeCache($instance->getCompiledContent(), $instance->getCompiledComponent());
        }
    }


    public static function buildView($file, $variables = [])
    {
        return new ViewSkeleton($file, $variables);
    }

}//end class
