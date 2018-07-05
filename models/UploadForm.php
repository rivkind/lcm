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
    public $upload_file;
    public $commentFile;

    public function rules()
    {
        return [
            [['upload_file'], 'file', 'skipOnEmpty' => false,'uploadRequired'=>"Ошибка"],
            [['commentFile'], 'string'],
        ];
    }

    public function upload()
    {

        if ($this->validate()) {
            $name_file = $this->imageFile->baseName;
            $filename = Yii::$app->params['fileUploadUrl'] . $name_file . '.' . $this->imageFile->extension;
            $cnt = 1;
            while (file_exists($filename)) {
                $filename =  Yii::$app->params['fileUploadUrl'] . $name_file . ' ('.$cnt.').' . $this->imageFile->extension;
                $cnt++;
            }
            if($cnt != 1) $name_file = $name_file . ' ('.($cnt-1).')';

            $this->imageFile->saveAs($filename);
            return $name_file.".".$this->imageFile->extension;
        } else {
            return false;
        }




    }

}