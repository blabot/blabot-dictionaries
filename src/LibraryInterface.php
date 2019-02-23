<?php

namespace Blabot;

interface LibraryInterface
{
    public function getCatalogue(): Catalogue;
    public function getDictionary(string $id): Dictionary;
}