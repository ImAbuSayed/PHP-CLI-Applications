<?php

class AlphaCounter {
    private $sentence;

    public function __construct($sentence) {
        $this->sentence = $sentence;
    }

    public function countAlphabets() {
        $filteredString = preg_replace('/[^a-zA-Z]/', '', $this->sentence);
        $count = strlen($filteredString);
        return $count;
    }
}

echo "Enter a sentence: ";
$sentence = trim(fgets(STDIN));

$alphaCounter = new AlphaCounter($sentence);
$count = $alphaCounter->countAlphabets();

echo "The number of alphabets in the sentence is: $count\n";
