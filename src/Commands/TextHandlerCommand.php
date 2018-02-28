<?php
namespace App\Commands;

use App\Services\CompositeTextHandler;
use App\Services\Handlers\HtmlSpecialCharsHandler;
use App\Services\Handlers\RemoveSpacesHandler;
use App\Services\Handlers\RemoveSymbolsHandler;
use App\Services\Handlers\ReplaceSpacesToEolHandler;
use App\Services\Handlers\StripTagsHandler;
use App\Services\Handlers\ToNumberHandler;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TextHandlerCommand extends ContainerAwareCommand
{

    private $config = [
        'stripTags' => StripTagsHandler::class,
        'removeSpaces' => RemoveSpacesHandler::class,
        'replaceSpacesToEol' => ReplaceSpacesToEolHandler::class,
        'htmlspecialchars' => HtmlSpecialCharsHandler::class,
        'removeSymbols' => RemoveSymbolsHandler::class,
        'toNumber' => ToNumberHandler::class
    ];

    private $textHandler;

    public function __construct(?string $name = null, CompositeTextHandler $handler)
    {
        parent::__construct($name);
        $this->textHandler = $handler;
    }

    protected function configure()
    {
        $this
            ->setName('app:run');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        stream_set_blocking(STDIN, false);

        $time = microtime(true);

        $prompt = '>';

        echo $prompt;

        while (true) {

            if (microtime(true) - $time > 5) {
                $time = microtime(true);
            }

            $message = file_get_contents("php://stdin");

            if ($message) {
                $output->writeln($this->handleText($message));
            }
        }
    }

    private function handleText(string $input): string
    {
        $container = $this->getContainer();
        $input = json_decode($input, true);

        foreach ($input['job']['methods'] as $method) {
            $handlerClassName = $this->config[$method];
            $this->textHandler->add($container->get($handlerClassName));
        }

        return $this->textHandler->handle($input['job']['text']);
    }
}