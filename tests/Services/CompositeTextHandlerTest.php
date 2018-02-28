<?php
namespace App\Tests\Services;

use App\Services\CompositeTextHandler;
use App\Services\Handlers\RemoveSpacesHandler;
use App\Services\Handlers\ToNumberHandler;
use PHPUnit\Framework\TestCase;

//Описаны, конечно, не все тесты кейсы. И я думаю, что лучше просто тестировать каждый хендлер отдельно
class CompositeTextHandlerTest extends TestCase
{
    /**
     * @var CompositeTextHandler
     */
    private $compositeTextHandler;

    private $testText = 'some test $ text 15';

    public function setUp()
    {
        $this->compositeTextHandler = new CompositeTextHandler();
    }

    public function testToNumber()
    {
        $this->compositeTextHandler->add(new ToNumberHandler());
        $result = $this->compositeTextHandler->handle($this->testText);

        $this->assertEquals(15, $result);
    }

    public function testToNumberWithRemoveSpaces()
    {
        $this->compositeTextHandler->add(new ToNumberHandler())->add(new RemoveSpacesHandler());
        $result = $this->compositeTextHandler->handle($this->testText);

        $this->assertEquals(15, $result);
    }

    public function testRemoveSpaces()
    {
        $this->compositeTextHandler->add(new RemoveSpacesHandler());
        $result = $this->compositeTextHandler->handle($this->testText);

        $this->assertEquals('sometest$text15', $result);
    }
}