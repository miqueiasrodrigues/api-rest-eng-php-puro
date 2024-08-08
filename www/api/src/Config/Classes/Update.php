<?php

namespace Config\Classes;

use App\Exceptions\AppException;


class Upload
{
    private $paramName;

    public function __construct($paramName = "")
    {
        $this->paramName = $paramName;
    }

    public function upload()
    {
        if (isset($_FILES[$this->paramName])) {
            $image = $_FILES[$this->paramName];

            if ($image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../../public/Images/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                $randomName = date('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $targetFile = $uploadDir . $randomName;

                if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                    return [
                        'status' =>  'success',
                        'message' => 'Imagem criado com sucesso.',
                        'data' => $randomName
                    ];
                } else {
                    throw new AppException(500, 'Erro ao mover o arquivo');
                }
            } else {
                throw new AppException(500, 'Erro no upload');
            }
        } else {
            return [
                'status' =>  'error',
                'message' => 'Imagem não criada.',
            ];
        }
    }

    public function remove($filename)
    {
        $uploadDir = __DIR__ . '/../../../public/Images/';
        $filePath = $uploadDir . $filename;

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                return [
                    'status' => 'success',
                    'message' => 'Arquivo removido com sucesso.',
                ];
            } else {
                throw new AppException(500, 'Erro ao remover o arquivo');
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'Arquivo não existe.',
            ];
        }
    }
}
