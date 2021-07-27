<?php


namespace Src\Engine\Dictionary;


use Src\Boot;

/**
 * Interface DictionaryInterface
 * @package Src\Engine\Dictionary
 */
interface DictionaryInterface
{
    /**
     * DictionaryInterface constructor.
     * @param Boot $boot
     */
    public function __construct(Boot $boot);

    /**
     * @return string
     */
    public function getPathToDict(): string;

    /**
     * @param string $pathToDict
     * @return Dictionary
     */
    public function setPathToDict(string $pathToDict): Dictionary;

    /**
     * @return array
     */
    public function getWords(): array;

    /**
     * @param string $word
     * @return bool
     */
    public function wordInWords(string $word): bool;

    /**
     * @param array $words
     * @return Dictionary
     */
    public function setWords(array $words): Dictionary;

    /**
     * @return string
     */
    public function getPathToValues(): string;

    /**
     * @param string $pathToValues
     * @return mixed
     */
    public function setPathToValues(string $pathToValues);

    /**
     * @return array
     */
    public function getValues(): array;

    /**
     * @param array $values
     * @return mixed
     */
    public function setValues(array $values);
}
