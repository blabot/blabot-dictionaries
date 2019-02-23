<?php
declare(strict_types=1);

use Blabot\JsonLibrary;
use PHPUnit\Framework\TestCase;

final class JsonLibraryTest extends TestCase
{
    /**
     * @var JsonLibrary $library
     */
    private $library;

    /**
     * @var \Blabot\Dictionaries\Tests\JsonAdapterStub $adapter
     */
    private $adapter;

    protected function setUp()
    {
        parent::setUp();
        $this->adapter = new \Blabot\Dictionaries\Tests\JsonAdapterStub();
        $this->library = new JsonLibrary($this->adapter);
    }

    public function testGivenAdapterReturnsCatalogue(): void
    {
        $actual = $this->library->getCatalogue();
        $this->assertInstanceOf(\Blabot\Catalogue::class, $actual);
    }

    public function testGivenDataReturnsValidCatalogue(): void
    {
        $catalogue = $this->library->getCatalogue();
        $catalogueRecords = $catalogue->listAll();
        $this->assertNotEmpty($catalogueRecords);
        $record = $catalogueRecords['cs.json'];
        $this->assertInstanceOf(\Blabot\CatalogueRecord::class, $record);
        $this->assertEquals($record->language, "cs");
        $this->assertEquals($record->name, "Modern Czech");
        $this->assertEquals($record->localName, "Moderní čeština");
        $this->assertEquals($record->other['author'], "Tomáš Kuba");
    }

    public function testGivenCatalogueIdReturnsRecord(): void
    {
        $catalogue = $this->library->getCatalogue();
        $record = $catalogue->findById('cs-capek.json');
        $this->assertInstanceOf(\Blabot\CatalogueRecord::class, $record);
        $this->assertEquals("Čapek czech", $record->name);
        $this->assertEquals("Čapekovská čeština", $record->localName);
        $this->assertEquals("Slovník vygenerovaný z povídek Karla Čapka", $record->other['descriptionLocal']);
    }

    public function testGivenInvaliIdThrowsException(): void
    {
        $this->expectException(\Blabot\LibraryException::class);
        $this->library->getDictionary('invalid-id');
    }

    public function testGivenCatalogueRecordReturnsDictionary(): void
    {
        $dictionary = $this->library->getDictionary('cs-capek.json');
        $this->assertInstanceOf(\Blabot\Dictionary::class, $dictionary);
        $this->assertEquals($dictionary->sentences[0], "<1> <2> <3>, <4> <5>.");
        $this->assertEquals($dictionary->words[4], ["jako"]);
    }
}