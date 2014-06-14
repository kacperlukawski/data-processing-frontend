<?php

class SumColumnValueTransform extends AbstractTransform {
    
    public function __construct($inputFileName, $outputFileName, array $options = array()) {
        parent::__construct($inputFileName, $outputFileName, $options);
    }
    
    public function transform() {
        $groupedValues = array();
        
        $currentLine = null;
        do {
            $currentLine = $this->getNextLine();
            
            
        } while ($currentLine !== null);
        
        foreach ($groupedValues as $groupValue) {
            $this->storeNextLine($groupValue);
        }
    }
    
}