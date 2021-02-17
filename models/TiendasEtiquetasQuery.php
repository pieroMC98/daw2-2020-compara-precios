<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TiendasEtiquetas]].
 *
 * @see TiendasEtiquetas
 */
class TiendasEtiquetasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TiendasEtiquetas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TiendasEtiquetas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
