<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Description Model
 *
 * @property \App\Model\Table\CustomerTable&\Cake\ORM\Association\BelongsTo $Customer
 *
 * @method \App\Model\Entity\Description newEmptyEntity()
 * @method \App\Model\Entity\Description newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Description[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Description get($primaryKey, $options = [])
 * @method \App\Model\Entity\Description findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Description patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Description[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Description|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Description saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Description[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Description[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Description[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Description[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DescriptionTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('description');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customer', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
        ]);
    }
}
