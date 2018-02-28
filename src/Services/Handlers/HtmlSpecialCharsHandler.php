<?php
namespace App\Services\Handlers;

use App\Services\TextHandlerInterface;

class HtmlSpecialCharsHandler implements TextHandlerInterface
{
    public function handle(string $text): string
    {
        return htmlspecialchars($text);
    }
}