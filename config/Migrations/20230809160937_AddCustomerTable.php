<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddCustomerTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('customer');

        $table->addColumn('kit_id', 'integer', [
                'null' => true,
            ])
            ->addIndex(['kit_id'])
            ->addForeignKey('kit_id', 'kit', 'id', [
                'update'=> 'CASCADE'
            ]);

        $table->addColumn('customer_name', 'text', [
            'null' => false,
        ]);

        $table->create();

    }
}
