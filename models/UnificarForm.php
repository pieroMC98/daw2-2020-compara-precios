<?php
namespace app\models;

use Yii;
use yii\base\Model;

class UnificarForm extends Model
{
    public $categoriaMantener_id;
    public $categoriaEliminar_id;

    public function rules()
    {
        return [
            [['categoriaMantener_id', 'categoriaEliminar_id'],'integer'],
        ];
    }
}