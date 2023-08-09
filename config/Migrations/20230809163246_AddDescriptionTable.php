<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddDescriptionTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('description');

        $table->addColumn('customer_id', 'integer', [
                'null' => false,
            ])
            ->addIndex(['customer_id'])
            ->addForeignKey('customer_id', 'customer', 'id');

        $table->addColumn('description', 'text', [
            'null' => false,
        ]);

        $table->create();
    }
}
