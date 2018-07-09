<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[WishList]].
 *
 * @see WishList
 */
class WishListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
	public function status()
    {
        return $this->andWhere("[[status]]='1'");
    }
    /**
     * {@inheritdoc}
     * @return WishList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WishList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
