<?php
namespace App\Services\Handlers;

use App\Services\TextHandlerInterface;

class ToNumberHandler implements TextHandlerInterface
{
    public function handle(string $text): string
    {
        $matches = [];
        preg_match('!\d+!', $text, $matches);

        return (int) $matches[0];
    }
}