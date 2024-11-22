<?php
namespace App\Controllers;
class Regax
{
    public function test()
    {
        $pattern = "#^/(?<controller>[a-z]+)/(?<action>[a-z]+)$#";
        $subject = "/drupak/view";
        if (preg_match($pattern, $subject, $matches)) {
            $matches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);
            // dump($matches);
            dump("it has Matched");
        } else {
            dump("it has not Matched");
        }
    }
}