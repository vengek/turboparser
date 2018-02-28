<?php
namespace App\Services;

interface TextHandlerInterface
{
    public function handle(string $text): string;
}