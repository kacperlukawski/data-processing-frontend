<?php

class SumColumnValueTransform extends AbstractTransform {

    /** @var string */
    protected $keyColumn;

    /** @var string */
    protected $valueColumn;

    public function __construct($inputFileName, $outputFileName, array $options = array()) {
        parent::__construct($inputFileName, $outputFileName, $options);

        $this->keyColumn = $options['key_column'];
        $this->valueColumn = $options['value_column'];
    }

    public function transform() {
        $groupedValues = array();

        $lineHeaders = $this->getNextLine();
        $currentLine = null;
        do {
            $currentLine = $this->getNextLine();
            if ($currentLine === null) {
                break;
            }

            if (count($currentLine) != count($lineHeaders)) {
                continue;
            }

            $lineValues = array_combine($lineHeaders, $currentLine);
            $lineKey = $lineValues[$this->keyColumn];
            $lineValue = $lineValues[$this->valueColumn];
            if (!isset($groupedValues[$lineKey])) {
                $groupedValues[$lineKey] = array(
                    $this->keyColumn => $lineKey,
                    $this->valueColumn => 0
                );
            }

            $groupedValues[$lineKey][$this->valueColumn] = $groupedValues[$lineKey][$this->valueColumn] + (float) $lineValue;
        } while ($currentLine !== null);

        if (count($groupedValues) > 0) {
            $this->storeNextLine(array($this->keyColumn, $this->valueColumn));

            foreach ($groupedValues as $groupValue) {
                $this->storeNextLine(array_values($groupValue));
            }
        }
    }

}
