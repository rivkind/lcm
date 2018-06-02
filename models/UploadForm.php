<?php
/**
 * Created by PhpStorm.
 * User: Alexey.Rivkind
 * Date: 01.06.2018
 * Time: 21:56
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $commentFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false,'uploadRequired'=>"Ошибка"],
            [['commentFile'], 'string'],
        ];
    }

    public function upload()
    {

        if ($this->validate()) {
            $name_file = iconv('UTF-8', 'WINDOWS-1251', $this->imageFile->baseName);

            $filename = Yii::$app->params['fileUploadUrl'] . $name_file . '.' . $this->imageFile->extension;
            $cnt = 1;
            while (file_exists($filename)) {
                $filename =  Yii::$app->params['fileUploadUrl'] . $name_file . ' ('.$cnt.').' . $this->imageFile->extension;
                $cnt++;
            }

            $this->imageFile->saveAs($filename);
            return true;
        } else {
            return false;
        }
    }
    public function checkNameFile()
    {
        $name_file = iconv('UTF-8', 'WINDOWS-1251', $this->imageFile->baseName);

        $filename = Yii::$app->params['fileUploadUrl'] . $name_file . '.' . $this->imageFile->extension;
        $cnt = 1;
        while (file_exists($filename)) {
            $filename =  Yii::$app->params['fileUploadUrl'] . $name_file . ' ('.$cnt.').' . $this->imageFile->extension;
            $cnt++;
        }
        $this->imageFile->name = $name_file . ' ('.($cnt-1).').' . $this->imageFile->extension;
    }
}