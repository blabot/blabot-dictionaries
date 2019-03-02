<?php
declare(strict_types=1);

namespace Blabot\StorageAdapter;


interface StorageAdapterInterface
{
    public function loadIndex(): string;
    public function loadDictionary($id): string;
}