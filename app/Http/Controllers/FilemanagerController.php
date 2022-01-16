<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilemanagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_filemanager = 'processFile';
        return view('filemanager.index' ,compact('type_filemanager') );

    }

    public function index_create()
    {
        return view('filemanager.create');

    }

    public function index_only()
    {
        return view('filemanager.only');

    }
    public function _audio()
    {
        $type_filemanager = 'processFileaudio';
        return view('filemanager.index', compact('type_filemanager'));

    }
    public function _files()
    {
        $_set_multiple = true;
        $type_filemanager = 'processFilesDoc';
        return view('filemanager.index', compact('type_filemanager', '_set_multiple'));
    }

    public function _vid()
    {
        $type_filemanager = 'processFileVid';
        return view('filemanager.index' ,compact('type_filemanager') );

    }

    public function editor()
    {
        $type_filemanager = 'processFileEditor';
        return view('filemanager.index' ,compact('type_filemanager') );
    }

    public function multiple_file()
    {
        $_set_multiple = true;
        $type_filemanager = 'processFile';
        return view('filemanager.index' ,compact('type_filemanager' , '_set_multiple') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        #dd(base_path('../public_html/files'));
        $opts = array(
            // 'debug' => true,
            'roots' => array(
                array(
                    'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
                    //'path'          => base_path('../public_html/files'),         // path to files (REQUIRED)
                    'path'          => base_path('../private_html/files'),         // path to files (REQUIRED)
                    'URL'           => '/files/', // URL to files (REQUIRED)
                    'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
                )
            )
        );
        ElfinderConfig( $opts );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('filemanager.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}