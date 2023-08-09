<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Kit Entity
 *
 * @property int $id
 * @property string $kit_id
 *
 * @property \App\Model\Entity\Customer[] $customer
 * @property \App\Model\Entity\Kit[] $kit
 */
class Kit extends Entity
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
        'customer' => true,
        'kit' => true,
    ];
}
