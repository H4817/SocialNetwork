tables: #change common/config/main-local.php before run this
	php yii migrate

install:
	composer update
	php init

update:
	php yii gii/model --tableName=comment --modelClass=BaseComment --baseClass="\yii\db\ActiveRecord" --ns="common\models\database" --overwrite=1 --interactive=0
	php yii gii/model --tableName=message --modelClass=BaseMessage --baseClass="\yii\db\ActiveRecord" --ns="common\models\database" --overwrite=1 --interactive=0
	php yii gii/model --tableName=passwordRecovery --modelClass=BasePasswordRecovery --baseClass="\yii\db\ActiveRecord" --ns="common\models\database" --overwrite=1 --interactive=0
	php yii gii/model --tableName=post --modelClass=BasePost --baseClass="\yii\db\ActiveRecord" --ns="common\models\database" --overwrite=1 --interactive=0
	php yii gii/model --tableName=user --modelClass=BaseUser --baseClass="\yii\db\ActiveRecord" --ns="common\models\database" --overwrite=1 --interactive=0
