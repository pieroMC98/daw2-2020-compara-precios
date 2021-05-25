<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Articulos]].
 *
 * @see Articulos
 */
class ArticulosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Articulos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Articulos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
