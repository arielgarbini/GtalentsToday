<?php

namespace Vanguard\Services\Upload;

use Vanguard\Category;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\File;

class CategoryAvatarManager
{
    const AVATAR_WIDTH = 160;

    const AVATAR_HEIGHT = 160;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Filesystem
     */
    private $fs;
    /**
     * @var ImageManager
     */
    private $imageManager;
    /**
     * @var Request
     */
    private $request;

    public function __construct(Filesystem $fs, ImageManager $imageManager, Request $request)
    {
        $this->fs = $fs;
        $this->imageManager = $imageManager;
        $this->request = $request;
    }

    /**
     * Upload and crop Category avatar to predefined width and height.
     *
     * @param Category $category
     * @return string Avatar file name.
     */
    public function uploadAndCropAvatar(Category $category)
    {
        list($name, $avatarImage) = $this->uploadFile($category);

        $this->cropAndResizeImage($avatarImage);

        return $name;
    }

    /**
     * Get uploaded file from HTTP request.
     *
     * @return array|null|\Symfony\Component\HttpFoundation\File\UploadedFile
     */
    private function getUploadedFileFromRequest()
    {
        return $this->request->file('avatar');
    }

    /**
     * Check if Category has uploaded avatar photo.
     * If he is using some external url for avatar, then
     * it is assumed that avatar is not uploaded manually.
     *
     * @param Category $category
     * @return bool
     */
    private function categoryHasUploadedAvatar(Category $category)
    {
        return $category->avatar && ! str_contains($category->avatar, ['http', 'gravatar']);
    }

    /**
     * Upload avatar photo for provided category and
     * delete old avatar if exists.
     *
     * @param Category $category
     * @return array
     */
    private function uploadFile(Category $category)
    {
        $this->deleteAvatarIfUploaded($category);

        $name = $this->generateAvatarName();
        $uploadedFile = $this->getUploadedFileFromRequest();

        $targetFile = $uploadedFile->move($this->getDestinationDirectory(), $name);

        return [$name, $targetFile];
    }

    /**
     * Get destination directory where avatar should be uploaded.
     *
     * @return string
     */
    private function getDestinationDirectory()
    {
        return public_path('upload/categories');
    }

    /**
     * @param Category $category
     */
    public function deleteAvatarIfUploaded(Category $category)
    {
        if ($this->categoryHasUploadedAvatar($category)) {
            $path = sprintf("%s/%s", $this->getDestinationDirectory(), $category->avatar);
            $this->fs->delete($path);
        }
    }

    /**
     * Build random avatar name.
     *
     * @return string
     */
    private function generateAvatarName()
    {
        $file = $this->getUploadedFileFromRequest();

        return sprintf(
            "%s.%s",
            md5(str_random() . time()),
            $file->getClientOriginalExtension()
        );
    }

    /**
     * Crop image from provided selected points and
     * resize it to predefined width and height.
     *
     * @param File $avatarImage
     * @return \Intervention\Image\Image
     */
    private function cropAndResizeImage(File $avatarImage)
    {
        $points = $this->request->get('points');
        $image = $this->imageManager->make($avatarImage->getRealPath());

        // Calculate delta between two points on X axis. This
        // value will be used as width and height for cropped image.
        $size = floor($points['x2'] - $points['x1']);

        return $image->crop($size, $size, (int) $points['x1'], (int) $points['y1'])
            ->resize(self::AVATAR_WIDTH, self::AVATAR_HEIGHT)
            ->save();
    }
}