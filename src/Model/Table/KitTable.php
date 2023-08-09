<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Kit Model
 *
 * @property \App\Model\Table\CustomerTable&\Cake\ORM\Association\HasMany $Customer
 * @property \App\Model\Table\KitTable&\Cake\ORM\Association\HasMany $Kit
 *
 * @method \App\Model\Entity\Kit newEmptyEntity()
 * @method \App\Model\Entity\Kit newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Kit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Kit get($primaryKey, $options = [])
 * @method \App\Model\Entity\Kit findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Kit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Kit[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Kit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kit[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Kit[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Kit[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Kit[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class KitTable extends Table
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

        $this->setTable('kit');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Customer', [
            'foreignKey' => 'kit_id',
        ]);
        $this->hasMany('Kit', [
            'foreignKey' => 'kit_id',
        ]);
    }
}
