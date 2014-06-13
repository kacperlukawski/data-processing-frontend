<?php

class DataFile extends Eloquent {

    /** @var string */
    protected $table = 'data_files';
    
    /**
     * Get the user that owns this file
     * 
     * @return User
     */
    public function user() {
        return $this->belongsTo('User');
    }
    
    /**
     * Get the list of all versions of current file
     * 
     * @return type
     */
    public function versions() {
        return $this->hasMany('DataFileVersion');
    }
    
    /**
     * Get current version of selected file
     * 
     * @return DataFileVersion
     */
    public function current(){
        return $this->belongsTo('DataFileVersion');
    }

}
