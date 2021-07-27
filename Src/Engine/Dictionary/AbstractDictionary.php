<?php


namespace Src\Engine\Dictionary;


use Src\Boot;
use Throwable;

abstract class AbstractDictionary implements DictionaryInterface
{
    /**
     * @var array
     */
    private array $words = array();

    /**
     * @var array
     */
    private array $values = array();

    /**
     * @var string
     */
    private string $pathToDict = '/filename.txt';

    /**
     * @var string
     */
    private string $pathToValues = '/filename.txt';

    /**
     * @inheritDoc
     */
    public function __construct(Boot $boot)
    {
        $this->setPathToDict($boot->getDictionaryFilePath());
        $this->setPathToValues($boot->getLetterValuesFilePath());
    }

    /**
     * @return string
     */
    public function getPathToDict(): string
    {
        return $this->pathToDict;
    }

    /**
     * @param string $pathToDict
     * @return Dictionary
     */
    public function setPathToDict(string $pathToDict): Dictionary
    {
        $this->pathToDict = $pathToDict;

        return $this;
    }

    /**
     * @return array
     */
    public function getWords(): array
    {
        if (empty($this->words)) {
            $this->loadDictionary();
        }

        return $this->words;
    }

    /**
     * @param string $word
     * @return bool
     */
    public function wordInWords(string $word): bool
    {
        $words = $this->getWords();

        return in_array($word, $words);
    }

    /**
     * @param array $words
     * @return Dictionary
     */
    public function setWords(array $words): Dictionary
    {
        $this->words = $words;

        return $this;
    }

    /**
     * @return string
     */
    public function getPathToValues(): string
    {
        return $this->pathToValues;
    }

    /**
     * @param string $pathToValues
     */
    public function setPathToValues(string $pathToValues)
    {
        $this->pathToValues = $pathToValues;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        if (empty($this->values)) {
            $this->loadLetterValues();
        }

        return $this->values;
    }

    /**
     * @param array $values
     */
    public function setValues(array $values)
    {
        $letterAndScore = array();

        foreach ($values as $letter) {
            $score = explode(':', $letter);
            $letterAndScore[$score[0]] = (int)$score[1];
        }

        $this->values = $letterAndScore;
    }

    /**
     * @return bool
     */
    private function loadDictionary(): bool
    {
        return $this->getDataFromFilesandSet($this->getPathToDict(), 'setWords');
    }

    /**
     * @return bool
     */
    private function loadLetterValues(): bool
    {
        return $this->getDataFromFilesandSet($this->getPathToValues(), 'setValues');
    }

    /**
     * @param string $path
     * @param string $method
     * @return bool
     */
    private function getDataFromFilesandSet(string $path, string $method): bool
    {
        try {
            if (is_file($path) && method_exists($this, $method)) {
                call_user_func(array($this, $method), file($path, FILE_SKIP_EMPTY_LINES) ?: array());

                return true;
            }
        }
        catch (Throwable $e) {
            error_log('Unable to accept: ' . $e->getMessage());
        }

        return false;
    }
}
