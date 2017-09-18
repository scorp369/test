<?php

namespace app\modules\user\models\filter;

use app\modules\user\models\User;
use yii\base\Model;
use yii\data\Pagination;

/**
 * фильтр пользователей
 */
class UserFilter extends Model
{
    /**
     * идентификатор
     *
     * @var integer
     */
    public $id;

    /**
     * логин
     *
     * @var string
     */
    public $login;

    /**
     * email
     *
     * @var string
     */
    public $email;

    /**
     * дата создания от
     *
     * @var string
     */
    public $createdAtFrom;

    /**
     * дата создания до
     *
     * @var string
     */
    public $createdAtTo;

    /**
     * дата крайней аутентификации от
     *
     * @var string
     */
    public $lastAuthenticateAtFrom;

    /**
     * дата крайней аутентификации до
     *
     * @var string
     */
    public $lastAuthenticateAtTo;

    /**
     * пагинация
     *
     * @var Pagination
     */
    public $pagination;

    /**
     * текущая страница
     *
     * @var integer
     */
    public $page = 1;

    /**
     * кол-во новостей на странице
     *
     * @var integer
     */
    public $pageSize;

    /** @inheritdoc */
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['login', 'email'], 'string'],
            [['createdAtFrom', 'createdAtTo', 'lastAuthenticateAtFrom', 'lastAuthenticateAtTo'], 'datetime', 'format' => 'd-m-Y H:i:s'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'id'                     => 'идентификатор',
            'login'                  => 'логин',
            'email'                  => 'email',
            'createdAtFrom'          => 'дата создания от',
            'createdAtTo'            => 'дата создания до',
            'lastAuthenticateAtFrom' => 'дата крайней аутентификации от',
            'lastAuthenticateAtTo'   => 'дата крайней аутентификации до',
        ];
    }

    /** @inheritdoc */
    public function init()
    {
        $this->pagination       = new Pagination();
        $this->pagination->page = 0;
    }

    /**
     * получить отфильтрованные
     *
     * @return User[]
     */
    public function getFiltered()
    {
        $query = User::find();

        // фильтр по идентификатору
        $query->andFilterWhere(['id' => $this->id]);

        // фильтр по логину
        $query->andFilterWhere(['login' => $this->login]);

        // фильтр по email
        $query->andFilterWhere(['email' => $this->email]);

        // фильтр по дате созданию
        $query->andFilterWhere(['>=', 'createdAt', $this->createdAtFrom]);

        // фильтр по дате созданию
        $query->andFilterWhere(['<=', 'createdAt', $this->createdAtTo]);

        // фильтр по дате крайней аутентификации от
        $query->andFilterWhere(['>=', 'lastAuthenticateAt', $this->lastAuthenticateAtFrom]);

        // фильтр по дате крайней аутентификации до
        $query->andFilterWhere(['<=', 'lastAuthenticateAt', $this->lastAuthenticateAtTo]);

        $this->pagination->setPage($this->page - 1);
        $this->pagination->setPageSize($this->pageSize);
        $this->pagination->totalCount = $query->count();

        $query->limit($this->pagination->getLimit())->offset($this->pagination->getOffset());

        return $query->all();
    }
}