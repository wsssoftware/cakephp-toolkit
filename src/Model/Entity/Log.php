<?php
declare(strict_types=1);

namespace Toolkit\Model\Entity;

use Cake\ORM\Entity;

/**
 * Log Entity
 *
 * @property int $id
 * @property string $type
 * @property string $message
 * @property string $summary
 * @property string|null $context
 * @property array|null $post_data
 * @property array|null $get_data
 * @property string|null $ip
 * @property string|null $hostname
 * @property string|null $uri
 * @property string|null $refer
 * @property string|null $user_agent
 * @property int|null $user_id
 * @property int|null $count
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property Entity|\AppCore\Model\Entity\User $user
 */
class Log extends Entity
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
        'type' => true,
        'message' => true,
        'summary' => true,
        'context' => true,
        'post_data' => true,
        'get_data' => true,
        'ip' => true,
        'hostname' => true,
        'uri' => true,
        'refer' => true,
        'user_agent' => true,
        'user_id' => true,
        'count' => true,
        'created' => true,
        'user' => true,
    ];

    /**
     * @return bool
     */
    public function isCli() {
        return $this->uri && str_starts_with($this->uri, 'CLI ');
    }
}
