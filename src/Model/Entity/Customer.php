<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property int|null $kit_id
 * @property string $customer_name
 *
 * @property \App\Model\Entity\Kit $kit
 * @property \App\Model\Entity\Description[] $description
 */
class Customer extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'kit_id' => true,
        'customer_name' => true,
        'kit' => true,
        'description' => true,
    ];
}
