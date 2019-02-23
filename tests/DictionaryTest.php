<?php
declare(strict_types=1);

use Blabot\Dictionary;
use PHPUnit\Framework\TestCase;

final class DictionaryTest extends TestCase
{
    private $dict;

    protected function setUp()
    {
        parent::setUp();
        $this->dict = new Dictionary();
    }

    public function testDictionaryClassExists(): void
    {
        $this->assertInstanceOf(Dictionary::class, $this->dict);
    }

    public function testDictionaryHasMeta(): void
    {
        $this->assertIsArray($this->dict->meta);
    }

    public function testDictionaryHasConfig(): void
    {
        $this->assertIsArray($this->dict->config);
    }

    public function testDictionaryHasSentences(): void
    {
        $this->assertIsArray($this->dict->sentences);
    }

    public function testDictionaryHasWords(): void
    {
        $this->assertIsArray($this->dict->words);
    }
}