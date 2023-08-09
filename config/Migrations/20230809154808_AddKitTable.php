<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddKitTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('kit')
            ->addColumn('kit_id', 'integer', [
                'null' => false,
            ])
            ->save();
    }
}
