<?php

abstract class AbstractTransform {

    /** @var string */
    protected $inputFileName;

    /** @var handle */
    protected $inputFileHandle;

    /** @var string */
    protected $outputFileName;

    /** @var handle */
    protected $outputFileHandle;

    /** @var array */
    protected $options;

    public function __construct($inputFileName, $outputFileName, array $options = array()) {
        $this->inputFileName = $inputFileName;
        $this->outputFileName = $outputFileName;
        $this->options = $options;

        $this->inputFileHandle = fopen($this->inputFileName, 'r');
        $this->outputFileHandle = fopen($this->outputFileName, 'w+');
    }

    public function __destruct() {
        fclose($this->inputFileHandle);
        fclose($this->outputFileHandle);
    }

    /**
     * Perform a transform on a data
     * 
     * @return void
     */
    public abstract function transform();

    /**
     * Return next line from input file
     * 
     * @return array|null
     */
    protected function getNextLine() {
        if (feof($this->inputFileHandle)) {
            return null;
        }

        return fgetcsv($this->inputFileHandle);
    }

    /**
     * Store next row in output file
     * 
     * @param array $values
     */
    protected function storeNextLine(array $values) {
        fputcsv($this->outputFileHandle, $values);
    }

}
