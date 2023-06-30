<?php
declare(strict_types=1);

namespace Toolkit\Model\Entity;

use Cake\ORM\Entity;

/**
 * SmsLog Entity
 *
 * @property int $id
 * @property string $phone
 * @property string $message
 * @property \Cake\I18n\FrozenTime $created
 */
class SmsLog extends Entity
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
        'phone' => true,
        'message' => true,
        'created' => true,
    ];
}
