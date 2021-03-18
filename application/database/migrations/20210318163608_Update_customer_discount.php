<?php

class Migration_Update_customer_discount extends CI_Migration
{

    public function up()
    {

        $this->dbforge->add_column('customer', [
            'discount' => [
                'type' => 'INT',
                'constraint' => 3
            ]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_column('customer', 'discount');
    }
}
