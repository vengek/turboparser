<?php
namespace App\Services\Handlers;

use App\Services\TextHandlerInterface;

class StripTagsHandler implements TextHandlerInterface
{
    public function handle(string $text): string
    {
        return strip_tags($text);
    }
}