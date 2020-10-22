<?php

use yii\db\Migration;

/**
 * Class m201022_100455_create_item_for_rbac
 */
class m201022_100455_create_item_for_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $auth->add($admin);

        $author = $auth->createRole('author');
        $author->description = 'Author';
        $auth->add($author);

        $superAdmin = $auth->createRole('super-admin');
        $superAdmin->description = 'Super Admin';
        $auth->add($superAdmin);

        //print_r($auth);
       // return false;

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        
        $admin = $auth->getRole('admin');
        if ($admin) {
            $auth->remove($admin);
        }

        $author = $auth->getRole('author');
        if ($author) {
            $auth->remove($author);
        }

        $superAdmin = $auth->getRole('super-admin');
        if ($superAdmin) {
            $auth->remove($superAdmin);
        }

        
        /*
        php yii migrate/down เพื่อลบ ใช้งาน public function safeDown()
        php yii migrate  เพื่อสร้าง ใช้งาน public function safeUp()
        */
        
        //echo "m201022_100455_create_item_for_rbac cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201022_100455_create_item_for_rbac cannot be reverted.\n";

        return false;
    }
    */
}
