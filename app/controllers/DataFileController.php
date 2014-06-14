<?php

class DataFileController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    public function getCreate() {
        return View::make('datafile.create')
                        ->with('datafile', Session::get('datafile'));
    }

    public function postCreate() {
        $dataFileInfo = array_merge(Input::only('name', 'description'), array(
            'file' => Input::file('file')
        ));

        $dataFileValidator = Validator::make($dataFileInfo, array(
                    'file' => 'required',
                    'name' => 'required',
                    'description' => 'required'
        ));

        if ($dataFileValidator->fails()) {
            $dataFileInfo['file'] = Input::get('file');

            return Redirect::action('DataFileController@getCreate')
                            ->with('datafile', $dataFileInfo)
                            ->withErrors($dataFileValidator);
        }

        $uniqFileName = uniqid('datafile_') . '.csv';

        $uploadedFile = Input::file('file');
        $uploadedFile->move('upload', $uniqFileName);

        $dataFile = new DataFile;
        $dataFile->user_id = Auth::user()->id;
        $dataFile->save();

        $dataFileVersion = new DataFileVersion;
        $dataFileVersion->data_file_id = $dataFile->id;
        $dataFileVersion->name = Input::get('name');
        $dataFileVersion->description = Input::get('description');
        $dataFileVersion->path = 'upload/' . $uniqFileName;
        $dataFileVersion->size = filesize($dataFileVersion->path);
        $dataFileVersion->push();

        $dataFile->version_id = $dataFileVersion->id;
        $dataFile->push();

        return Redirect::action('DataFileController@getShow', array($dataFile->id));
    }

    public function getList() {
        $user = Auth::user();
        $dataFiles = DataFile::where('user_id', '=', $user->id)->get();
        return View::make('datafile.list')
                        ->with('dataFiles', $dataFiles);
    }

    public function getShow($dataFileId) {
        $dataFile = $this->getDataFileIfAllowed($dataFileId);
        return View::make('datafile.show')
                        ->with('dataFile', $dataFile)
                        ->with('fileHeaders', $dataFile->current->path);
    }

    public function getEdit($dataFileVersionId) {
        $dataFileVersion = $this->getDataFileVersionIfAllowed($dataFileVersionId);
        return View::make('datafile.edit')
                        ->with('dataFileVersion', $dataFileVersion);
    }

    public function postEdit() {
        $dataFileVersionId = Input::get('id');
        $dataFileVersion = $this->getDataFileVersionIfAllowed($dataFileVersionId);

        $dataFileVersionInfo = Input::only('name', 'description');
        $dataFileValidator = Validator::make($dataFileVersionInfo, array(
                    'name' => 'required',
                    'description' => 'required'
        ));

        if ($dataFileValidator->fails()) {
            return Redirect::action('DataFileController@getEdit')
                            ->withErrors($dataFileValidator);
        }

        $dataFileVersion->name = Input::get('name');
        $dataFileVersion->description = Input::get('description');
        $dataFileVersion->push();

        return Redirect::action('DataFileController@getShow', array($dataFileVersion->data_file_id));
    }

    public function getHistory($dataFileId) {
        $dataFile = $this->getDataFileIfAllowed($dataFileId);
        return View::make('datafile.history')
                        ->with('dataFile', $dataFile);
    }

    public function getDownload($dataFileVersionId) {
        $dataFileVersion = $this->getDataFileVersionIfAllowed($dataFileVersionId);
        return Response::download($dataFileVersion->path);
    }

    public function postTransform() {
        $dataFileVersionId = Input::get('version_id');
        $transformName = Input::get('transform');

        $dataFileCurrentVersion = $this->getDataFileVersionIfAllowed($dataFileVersionId);
        $dataFile = $dataFileCurrentVersion->file;

        $uniqFileName = uniqid('datafile_') . '.csv';
        copy($dataFileCurrentVersion->path, 'upload/' . $uniqFileName);

        $dataFileNewVersion = new DataFileVersion;
        $dataFileNewVersion->data_file_id = $dataFile->id;
        $dataFileNewVersion->name = $dataFileCurrentVersion->name;
        $dataFileNewVersion->description = $dataFileCurrentVersion->description;
        $dataFileNewVersion->path = 'upload/' . $uniqFileName;
        $dataFileNewVersion->size = filesize($dataFileNewVersion->path);
        $dataFileNewVersion->push();

        $dataFile->version_id = $dataFileNewVersion->id;
        $dataFile->push();

        return Redirect::action('DataFileController@getShow', array($dataFile->id));
    }

    /**
     * Check if current user is allowed to use specified file. If not, throws
     * an error that should be handled somewhere else.
     * 
     * @param int $dataFileId
     * @return DataFile
     */
    private function getDataFileIfAllowed($dataFileId) {
        $user = Auth::user();
        $dataFile = DataFile::find($dataFileId);

        if ($dataFile === null) {
            App::abort(404);
        }

        if (!($dataFile->user_id == $user->id)) {
            App::abort(403);
        }

        return $dataFile;
    }

    /**
     * Check if current user is allowed to use specified file and get selected version. 
     * If not, throws an error that should be handled somewhere else.
     * 
     * @param int $dataFileVersionId
     * @return DataFileVersion
     */
    private function getDataFileVersionIfAllowed($dataFileVersionId) {
        $user = Auth::user();
        $dataFileVersion = DataFileVersion::find($dataFileVersionId);

        if ($dataFileVersion === null) {
            App::abort(404);
        }

        if (!($dataFileVersion->file->user_id == $user->id)) {
            App::abort(403);
        }

        return $dataFileVersion;
    }

}
