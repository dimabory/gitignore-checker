<?php

declare(strict_types=1);

namespace Inmarelibero\GitIgnoreChecker\Tests;

class GitIgnoreCheckerTest extends AbstractTestCase
{
    /**
     * @dataProvider provideIgnoredPath
     */
    public function testIsPathIgnored(string $path): void
    {
        $this->assertTrue($this->gitIgnoreChecker->isPathIgnored($path));
    }

    /**
     * @dataProvider provideNotIgnoredPath
     */
    public function testIsNotPathIgnored(string $path): void
    {
        $this->assertFalse($this->gitIgnoreChecker->isPathIgnored($path));
    }

    public function provideIgnoredPath(): \Generator
    {
        yield 'foo/ignore_me' => ['/foo/ignore_me'];
        yield 'ignored_foo' => ['/ignored_foo'];
        yield '#README' => ['/#README'];
        yield '#folder' => ['/#folder'];
        yield '#folder/test' => ['/#folder/test'];
        yield '#folder/#test' => ['/#folder/#test'];
        yield 'tes#t' => ['/tes#t'];
    }

    public function provideNotIgnoredPath()
    {
        yield '.foo' => ['/.foo'];
        yield '.foo/bar_folder/README' => ['/.foo/bar_folder/README'];
        yield 'README.md' => ['/README.md'];
    }
}
