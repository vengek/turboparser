<?php
namespace App\Services\Handlers;

use App\Services\TextHandlerInterface;

class RemoveSpacesHandler implements TextHandlerInterface
{
    public function handle(string $text): string
    {
        return str_replace(' ', '', $text);
    }
}