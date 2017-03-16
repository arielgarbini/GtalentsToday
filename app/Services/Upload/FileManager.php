<?php

namespace Vanguard\Services\Upload;

use Vanguard\Repositories\Candidate\CandidateRepository;
use Vanguard\Repositories\Vacancy\VacancyRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;

class FileManager
{
    /**
     * @var CandidateRepository
     */
    protected $candidate;
    /**
     * @var VacancyRepository
     */
    protected $vacancy;
    /**
     * @var Filesystem
     */
    private $fs;
    /**
     * @var Request
     */
    private $request;

    public function __construct(Filesystem $fs, 
                                Request $request, 
                                CandidateRepository $candidate, 
                                VacancyRepository $vacancy)
    {
        $this->fs = $fs;
        $this->request = $request;
        $this->candidate = $candidate;
        $this->vacancy = $vacancy;
    }

    /**
     * Upload file to predefined width and height.
     *
     * @param $type
     * @param $id
     * @return string file name.
     */
    public function uploadFile($type, $id)
    {
        if($type == 'vacancy')
            $model = $this->vacancy->find($id);
        else if($type == 'candidate')
            $model = $this->candidate->find($id);

        if ($model->file) {
            $path = sprintf("%s/%s", $this->getDestinationDirectory(), $model->file);
            $this->fs->delete($path);
        }

        $name = $this->generateFileName();
        $uploadedFile = $this->getUploadedFileFromRequest();

        $targetFile = $uploadedFile->move($this->getDestinationDirectory(), $name);

        return $name;
    }

    /**
     * Get uploaded file from HTTP request.
     *
     * @return array|null|\Symfony\Component\HttpFoundation\File\UploadedFile
     */
    private function getUploadedFileFromRequest()
    {
        return $this->request->file('file');
    }

    /**
     * Get destination directory where File should be uploaded.
     *
     * @return string
     */
    private function getDestinationDirectory()
    {
        return public_path('upload/docs');
    }

    /**
     * Build random File name.
     *
     * @return string
     */
    private function generateFileName()
    {
        $file = $this->getUploadedFileFromRequest();

        return sprintf(
            "%s.%s",
            md5(str_random() . time()),
            $file->getClientOriginalExtension()
        );
    }
}