<?php

class DataFileController extends BaseController {
    
    public function getShow($dataFileId) {
        // display file with current version info
    }
    
    public function getHistory($dataFileId) {
        // display full history of selected file
    }
    
    public function getDownload($dataFileVersionId) {
        // download selected version of file
    }
    
    public function postTransform($id) {
        // transform selected file
        // create new version
        // store information
    }
    
}