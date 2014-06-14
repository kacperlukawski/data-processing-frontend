<?php

class TransformHelper {

    /**
     * Get the list of available data transforms
     * 
     * @return array
     */
    public static function getAvailableTransforms() {
        return array(
            'sum_column_value' => 'Sum value of column'
        );
    }
    
    /**
     * Get headers of the file from given path
     * 
     * @param string $filePath
     * @return array
     */
    public static function getFileHeaders($filePath) {
        if (!file_exists($filePath)) {
            return array();
        }
        
        $fileHandle = fopen($filePath, 'r');
        $fileHeaders = fgetcsv($fileHandle);
        fclose($fileHandle);
        
        return array_combine($fileHeaders, $fileHeaders);
    }

    /**
     * Creates transform object by selected type
     * 
     * @param string $transformType
     * @param string $inputFileName
     * @param string $outputFileName
     * @param array $options
     * @return AbstractTransform
     */
    public static function createTransform($transformType, $inputFileName, $outputFileName, array $options = array()) {
        switch ($transformType) {
            case 'sum_column_value':
                return new SumColumnValueTransform($inputFileName, $outputFileName, $options);
        }
    }

}
