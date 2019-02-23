<?php
declare(strict_types=1);

namespace Blabot;


interface StorageAdapterInterface
{
    public function loadIndex(): string;
    public function loadDictionary($id): string;
}