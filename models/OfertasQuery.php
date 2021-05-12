<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Oferta]].
 *
 * @see Oferta
 */
class OfertasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Oferta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Oferta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
