<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:48
 */

namespace App\Services;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class FileService
{
    protected $defaultPath;
    protected $defaultPathAttachments;
    protected $defaultPathReceipts;

    public function __construct()
    {
        $this->defaultPath = config('filesystems.disks.s3.path', 'fornecedor/ordersprograms/');

    }

    /**
     * Gera um nome de arquivo
     *
     * @param string $extension
     * @return string $filename
     */
    private function generateName($extension)
    {
        return time() . time() . '.' . $extension;
    }

    /**
     * @param $mimetype
     * @return mixed
     */
    private function getExtensionByMimetype($mimetype)
    {
        return config('filesystems.mimes')[$mimetype];
    }

    /**
     * Realiza upload de arquivo
     *
     * @param UploadedFile $file
     * @param string $path
     * @return array $filename
     */
    public function upload(UploadedFile $file, $path = null)
    {
        if (empty($path)) {
            $path = $this->defaultPath;
        }

        $fileName = self::generateName($file->extension());
        $mimeType = $file->getMimeType();

        if (!Storage::disk('s3')->put($path . $fileName, file_get_contents($file->getRealPath()))) {
            throw new UploadException();
        }

        return [
            'path' => $path,
            'file' => $fileName,
            'mime' => $mimeType,
        ];
    }

    /**
     * @param $file
     * @return string
     */
    public function uploadBase64Image($file)
    {
        $fileName = self::generateName(self::getExtensionByMimetype($file['filetype']));

        if (!Storage::disk('s3')->put($this->defaultPath . $fileName, base64_decode($file['value']))) {
            throw new UploadException();
        }

        return $this->defaultPath . $fileName;
    }
}
