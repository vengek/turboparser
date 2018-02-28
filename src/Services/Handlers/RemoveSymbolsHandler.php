<?php
namespace App\Services\Handlers;

use App\Services\TextHandlerInterface;

class RemoveSymbolsHandler implements TextHandlerInterface
{
    private $toRemove = [
        '&',
        '!',
        '$',
        '%'
    ];

    public function handle(string $text): string
    {
        foreach ($this->toRemove as $symbol) {
            $text = str_replace($symbol, '', $text);
        }

        return $text;
    }
}