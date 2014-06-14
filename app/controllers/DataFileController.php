<?php

class DataFileController extends BaseController {
    
    public function getCreate() {
        // display adding new file form
    }
    
    public function postCreate() {
        // get sent CSV file
    }
    
    public function getShow($dataFileId) {
        $user = Auth::user();
        $dataFile = DataFile::find($dataFileId);
        
        if ($dataFile === null) {
            App::abort(404);
        }
        
        if (!($dataFile->user_id == $user->id)) {
            App::abort(403);
        }
        
        return print_r(Session::all(), true);
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