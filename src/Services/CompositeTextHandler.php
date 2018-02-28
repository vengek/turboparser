<?php
namespace App\Services;

class CompositeTextHandler implements TextHandlerInterface
{
    private $handlers = [];

    public function handle(string $text): string
    {
       foreach ($this->handlers as $handler) {
           $text = $handler->handle($text);
       }

       return $text;
    }

    public function add(TextHandlerInterface $handler): self
    {
        $this->handlers[] = $handler;

        return $this;
    }
}