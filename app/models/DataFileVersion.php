<?php

class DataFileVersion extends Eloquent {

    /** @var string */
    protected $table = 'data_file_versions';

    /**
     * Get the data file that is described by this version
     * 
     * @return DataFile
     */
    public function file() {
        return $this->belongsTo('DataFile');
    }

}
