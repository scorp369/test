<?php

/**
 * страница со списком пользователей
 *
 * @var View         $this
 * @var User[]       $userList     - список пользователей
 * @var UserFilter   $userFilter   - фильтр пользователей
 * @var UserEditForm $userEditForm - форма редактирования пользователей
 */

use app\modules\user\forms\UserEditForm;
use app\modules\user\models\filter\UserFilter;
use app\modules\user\models\User;
use app\components\mvc\view\View;
use app\modules\user\UserModule;
use yii\helpers\Html;

$this->title = 'список пользователей';

$this->registerModuleAssets(['userEdit.js']);

?>

<h1>Список пользователей</h1>

<!-- фильтр пользователей -->
<?= $this->render('_user-filter', ['userFilter' => $userFilter]) ?>

<!-- ссылка создания пользователя -->
<?= Html::a('создать пользователя', createUrl(UserModule::USER_CREATE), ['class' => 'btn btn-default']) ?>

<!-- пагинация -->
<?= $this->render('_pagination', ['pagination' => $userFilter->pagination]) ?>

<!-- список пользователей -->
<?= $this->render('_user-list', ['userList' => $userList]) ?>

<!-- модальное окно редактирования пользователем -->
<?= $this->render('_user-edit', ['userEditForm' => $userEditForm]) ?>
