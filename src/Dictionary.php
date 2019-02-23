<?php
declare(strict_types=1);

namespace Blabot;

class Dictionary
{
    /**
     * @var array $meta
     */
    public $meta = [];

    /**
     * @var array $config
     */
    public $config = [];

    /**
     * @var array $words
     */
    public $words = [];

    /**
     * @var array $sentences
     */
    public $sentences = [];

    /**
     * Dictionary constructor.
     *
     * @param array $meta
     * @param array $config
     * @param array $words
     * @param array $sentences
     */
    public function __construct(array $meta = [], array $config = [], array $words = [], array $sentences = [])
    {
        $this->meta = $meta;
        $this->config = $config;
        $this->words = $words;
        $this->sentences = $sentences;
    }


}