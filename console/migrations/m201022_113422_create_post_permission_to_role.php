<?php

use yii\db\Migration;

/**
 * Class m201022_113422_create_post_permission_to_role
 */
class m201022_113422_create_post_permission_to_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        //getRole
        $author = $auth->getRole('author');
        $admin = $auth->createRole('admin');
        $superAdmin = $auth->createRole('super-admin');
        //getPermission
        $listPost = $auth->getPermission('post-index');
        $createPost = $auth->getPermission('post-create');
        $deletePost = $auth->createPermission('post-delete');
        $updatePost = $auth->createPermission('post-update');
        $viewPost = $auth->createPermission('post-view');
        //assign
        $auth->addChild($author, $createPost);
        $auth->addChild($author, $listPost);
        $auth->addChild($author, $viewPost);
        $auth->addChild($author, $updatePost);
        $auth->addChild($admin, $author);
        $auth->addChild($superAdmin, $admin);
        $auth->addChild($superAdmin, $deletePost);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201022_113422_create_post_permission_to_role cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201022_113422_create_post_permission_to_role cannot be reverted.\n";

        return false;
    }
    */
}
