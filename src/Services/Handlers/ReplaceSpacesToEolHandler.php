<?php
namespace App\Services\Handlers;

use App\Services\TextHandlerInterface;

class ReplaceSpacesToEolHandler implements TextHandlerInterface
{
    public function handle(string $text): string
    {
        return str_replace(' ', PHP_EOL, $text);
    }
}