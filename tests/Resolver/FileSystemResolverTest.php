<?php

declare(strict_types=1);

use NCAShortlink\Resolver\FileSystemResolver;
use NCAShortlink\Resolver\ResolverInterface;
use PHPUnit\Framework\TestCase;

class FileSystemResolverTest extends TestCase
{
    // https://foo.bar/x -> https://foo.bar/test/foo/bar/baz/quux

    /**
     * @var ResolverInterface
     */
    protected $resolver;

    public function setUp()
    {
        $this->resolver = new FileSystemResolver();
    }

    public function testResolvesToNullOnInvalidFile()
    {
        $result = $this->resolver->resolveUri('bullshit');

        $this->assertNull($result);
    }

    public function testResolvesToFileContents()
    {
        file_put_contents(sys_get_temp_dir() . '/bullshit.txt', 'test');
        $result = $this->resolver->resolveUri('bullshit');

        unlink(sys_get_temp_dir(). '/bullshit.txt');

        $this->assertEquals($result, 'test');
    }

    public function testFailsOnInvalidArgumentTypeForConstructor()
    {
        $this->expectException(RuntimeException::class);
        new FileSystemResolver('testfy');
    }
}
