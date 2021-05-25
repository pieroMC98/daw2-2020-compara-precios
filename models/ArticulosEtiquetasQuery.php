<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ArticulosEtiquetas]].
 *
 * @see ArticulosEtiquetas
 */
class ArticulosEtiquetasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ArticulosEtiquetas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ArticulosEtiquetas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
