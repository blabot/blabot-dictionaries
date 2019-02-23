<?php
declare(strict_types=1);

namespace Blabot;


use mysql_xdevapi\Exception;

class LocalFSAdapter implements StorageAdapterInterface
{
    /**
     * @var string $indexFile
     */
    private $indexFile;

    /**
     * @var string $dataDir
     */
    private $dataDir;

    /**
     * LocalFSAdapter constructor.
     *
     * @param string $indexFile
     * @param string $dataDir
     */
    public function __construct(string $indexFile, string $dataDir)
    {
        $this->indexFile = $indexFile;
        $this->dataDir = $dataDir;
    }

    /**
     * @return string
     * @throws FilesystemException
     */
    public function loadIndex(): string
    {
        if (!file_exists($this->indexFile))
            throw new FilesystemException("Index file: '" . $this->indexFile . "' does not exists");
        return file_get_contents($this->indexFile);
    }

    /**
     * @param $id
     * @return string
     * @throws FilesystemException
     */
    public function loadDictionary($id): string
    {
        $dictionaryFile = $this->dataDir . '/' . $id;
        if (!file_exists($dictionaryFile))
            throw new FilesystemException("Dictionary file: '" . $dictionaryFile . "' does not exists");
        return file_get_contents($dictionaryFile);
    }

}