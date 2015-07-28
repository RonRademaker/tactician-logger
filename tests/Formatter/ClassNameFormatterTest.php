<?php
namespace League\Tactician\Logger\Tests\Formatter;

use League\Tactician\Logger\Formatter\ClassNameFormatter;
use League\Tactician\Logger\Tests\Fixtures\RegisterUserCommand;
use League\Tactician\Logger\Tests\Fixtures\UserAlreadyExistsException;

class ClassNameFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClassNameFormatter
     */
    private $formatter;

    protected function setUp()
    {
        $this->formatter = new ClassNameFormatter();
    }

    public function testCommandSuccessCreatesExpectedMessage()
    {
        $this->assertEquals(
            'Command succeeded: League\Tactician\Logger\Tests\Fixtures\RegisterUserCommand',
            $this->formatter->commandHandled(new RegisterUserCommand())
        );
    }

    public function testCommandReceivedCreatesExpectedMessage()
    {
        $this->assertEquals(
            'Command received: League\Tactician\Logger\Tests\Fixtures\RegisterUserCommand',
            $this->formatter->commandReceived(new RegisterUserCommand())
        );
    }

    public function testCommandFailedCreatesExpectedMessage()
    {
        $exception = new UserAlreadyExistsException("foo bar baz");

        $expectedMessage = 'Command failed: League\Tactician\Logger\Tests\Fixtures\RegisterUserCommand threw the exception '
            . UserAlreadyExistsException::class . ' (foo bar baz)';

        $this->assertEquals(
            $expectedMessage,
            $this->formatter->commandFailed(new RegisterUserCommand(), $exception)
        );
    }
}
