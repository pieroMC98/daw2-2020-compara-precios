<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SeguimientosUsuario]].
 *
 * @see SeguimientosUsuario
 */
class SeguimientosUsuarioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SeguimientosUsuario[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SeguimientosUsuario|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
