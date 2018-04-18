<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $category_id
 * @property \App\Model\Entity\Category $category
 * @property int $subcategory_id
 * @property \App\Model\Entity\Subcategory $subcategory
 * @property int $availableqty
 * @property int $quantity
 * @property int $prize
 * @property string $title
 * @property string $description
 * @property string $tags
 * @property int $payementmethod_id
 * @property string $image
 * @property \App\Model\Entity\Cart[] $carts
 * @property \App\Model\Entity\Transaction[] $transactions
 */
class Product extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
