<?php

if (!function_exists("test")) {
    function test()
    {
        return "working";
    }
}

if (!function_exists("getParseUrl")) {
    function getParseUrl($url)
    {
        if (strpos($url, "//via.placeholder.com")) {
            return $url;
        }

        $resultUrl = substr($url, strpos($url, "/books") + 1);
        return $resultUrl;
    }
}
