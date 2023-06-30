<?php
declare(strict_types = 1);

namespace Toolkit\Validation;


use Cake\I18n\Number;
use Cake\Utility\Text;
use FFMpeg\FFMpeg;
use getID3;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\ImageManagerStatic;
use Laminas\Diactoros\UploadedFile;
use PHPUnit\Exception;
use wapmorgan\MediaFile\Exceptions\FileAccessException;
use wapmorgan\MediaFile\MediaFile;

class WSSValidationUpload
{


    /**
     * Check if is valid mime type
     *
     * @param \Laminas\Diactoros\UploadedFile|mixed $check
     * @param array $mimeTypes
     * @return boolean
     */
    public static function isValidMimeType(UploadedFile $check, array $mimeTypes)
    {
        if (in_array($check->getClientMediaType(), $mimeTypes)) {
            return true;
        }
        return false;
    }


    /**
     * Check if is valid file under server configuration
     *
     * @param \Laminas\Diactoros\UploadedFile|mixed $check
     * @return boolean
     */
    public static function isValidFileUnderServerConfiguration(UploadedFile $check)
    {
        switch ($check->getError()) {
            case UPLOAD_ERR_INI_SIZE:
                return __('O arquivo enviado excede a diretiva "upload_max_filesize" em php.ini');
            case UPLOAD_ERR_FORM_SIZE:
                return __('O arquivo enviado excede a diretiva MAX_FILE_SIZE que foi especificada no formulário HTML');
            case UPLOAD_ERR_PARTIAL:
                return __('O arquivo selecionado foi carregado apenas parcialmente');
            case UPLOAD_ERR_NO_TMP_DIR:
                return __('Faltando uma pasta temporária');
            case UPLOAD_ERR_CANT_WRITE:
                return __('Falha ao gravar arquivo no disco');
            case UPLOAD_ERR_EXTENSION:
                return __('Uma extensão PHP interrompeu o upload do arquivo');
            default:
                return true;
        }
    }


    /**
     * Check if is image size
     *
     * @param \Laminas\Diactoros\UploadedFile|mixed $check
     * @param int|null $width
     * @param int|null $height
     * @param bool $ignoreIfNotImage
     * @return boolean
     */
    public static function isImageSize(UploadedFile $check, ?int $width, ?int $height, bool $ignoreIfNotImage = false)
    {
        $type = explode('/', $check->getClientMediaType());
        $type = !empty($type[0]) ? $type[0] : 'empty';
        if ($type !== 'image' && $ignoreIfNotImage === true) {
            return true;
        }
        $imageSize = getimagesize($check->getStream()->getMetadata('uri'));
        if ($imageSize === false) {
            return __('Falha ao descobrir o tamanho da imagem');
        }
        $imageWidth = $imageSize[0];
        $imageHeight = $imageSize[1];
        if (!empty($width) && !empty($height) && ($width !== $imageWidth || $height !== $imageHeight)) {
            $size = Number::format($width) . "x" . Number::format($height);
            $imageSize = Number::format($imageWidth) . "x" . Number::format($imageHeight);
            return __('A imagem deve ter "{0}px" porem foi encontrado "{1}px"', $size, $imageSize);
        } elseif (!empty($width) && $width !== $imageWidth) {
            return __('A imagem deve ter "{1}px" de {0} porem foi encontrado "{2}px"', __('largura'), Number::format($width), Number::format($imageWidth));
        } elseif (!empty($height) && $height !== $imageHeight) {
            return __('A imagem deve ter "{1}px" de {0} porem foi encontrado "{2}px"', __('altura'), Number::format($height), Number::format($imageHeight));
        }

        return true;
    }


    /**
     * Check if is video size
     *
     * @param \Laminas\Diactoros\UploadedFile|mixed $check
     * @param int|null $width
     * @param int|null $height
     * @param bool $ignoreIfNotVideo
     * @return boolean
     */
    public static function isVideoSize(UploadedFile $check, ?int $width, ?int $height, bool $ignoreIfNotVideo = false)
    {
        $type = explode('/', $check->getClientMediaType());
        $type = !empty($type[0]) ? $type[0] : 'empty';
        if ($type !== 'video' && $ignoreIfNotVideo === true) {
            return true;
        }
        try {
            $getID3 = new getID3;
            $fileInfo = $getID3->analyze($check->getStream()->getMetadata('uri'));
        } catch (Exception $exception) {
            return __('Falha ao descobrir o tamanho do video com a seguinte mensagem {0}', $exception->getMessage());
        }
        if (!empty($fileInfo['error'])) {
            return Text::toList($fileInfo['error']);
        }
        $imageWidth = !empty($fileInfo['video']['resolution_x']) ? $fileInfo['video']['resolution_x'] : 0;
        $imageHeight = !empty($fileInfo['video']['resolution_y']) ? $fileInfo['video']['resolution_y'] : 0;
        if (!empty($width) && !empty($height) && ($width !== $imageWidth || $height !== $imageHeight)) {
            $size = Number::format($width) . "x" . Number::format($height);
            $imageSize = Number::format($imageWidth) . "x" . Number::format($imageHeight);
            return __('O video deve ter "{0}px" porem foi encontrado "{1}px"', $size, $imageSize);
        } elseif (!empty($width) && $width !== $imageWidth) {
            return __('O video deve ter "{1}px" de {0} porem foi encontrado "{2}px"', __('largura'), Number::format($width), Number::format($imageWidth));
        } elseif (!empty($height) && $height !== $imageHeight) {
            return __('O video deve ter "{1}px" de {0} porem foi encontrado "{2}px"', __('altura'), Number::format($height), Number::format($imageHeight));
        }

        return true;
    }
}