<?php
declare(strict_types=1);

namespace Blabot;

class JsonLibrary implements LibraryInterface
{
    /**
     * @var StorageAdapterInterface $adapter
     */
    private $adapter;

    /**
     * @var Catalogue $catalogue ;
     */
    private $catalogue;

    /**
     * JsonLibrary constructor.
     *
     * @param $adapter
     */
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
        $this->catalogue = new Catalogue();
        $this->parseCatalogue();
    }

    /**
     * @return Catalogue
     */
    public function getCatalogue(): Catalogue
    {
        return $this->catalogue;
    }

    /**
     * @param string $id
     * @return Dictionary
     * @throws LibraryException
     */
    public function getDictionary(string $id): Dictionary
    {
        if (!$this->catalogue->isValidId($id))
            throw new LibraryException("Unknow Catalogue record ID");
        $dictionary = $this->parseDictionary($id);
        return $dictionary;
    }

    private function parseCatalogue(): void
    {
        $index = json_decode($this->adapter->loadIndex(), true);
        foreach ($index as $dictionaries) {
            foreach ($dictionaries as $file => $dictionary) {
                $other = $dictionary;
                unset($other['name'], $other['nameLocal'], $other['language']);
                $this->catalogue->addRecord($file, $dictionary['language'], $dictionary['name'], $dictionary['nameLocal'], $other);
            }
        }
    }

    /**
     * @param string $id
     * @return Dictionary
     */
    private function parseDictionary(string $id): Dictionary
    {
        $record = $this->catalogue->findById($id);
        $dictArray = json_decode($this->adapter->loadDictionary($record->id), true);
        $dictionary = new Dictionary($dictArray['meta'], $dictArray['config'], $dictArray['words'], $dictArray['sentences']);
        return $dictionary;
    }
}