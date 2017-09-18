<?php

namespace app\modules\news\models\filter;

use app\modules\news\models\News;
use yii\base\Model;
use yii\data\Pagination;

/**
 * фильтр новостей
 */
class NewsFilter extends Model
{
    /**
     * идентификатор
     *
     * @var integer
     */
    public $id;

    /**
     * название
     *
     * @var string
     */
    public $name;

    /**
     * описание
     *
     * @var string
     */
    public $description;

    /**
     * статус
     *
     * @var string
     */
    public $state;

    /**
     * дата создания от
     *
     * @var string
     */
    public $createdAtFrom;

    /**
     * дата создание до
     *
     * @var string
     */
    public $createdAtTo;

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

    /**
     * login пользователя
     *
     * @var integer
     */
    public $userLogin;

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['id', 'pageSize', 'page'], 'integer'],
            [['name', 'description', 'userLogin'], 'string'],
            ['state', 'in', 'range' => ['0', '1']],
            [['createdAtFrom', 'createdAtTo'], 'datetime', 'format' => 'd-m-Y H:i:s'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'id'            => 'идентификатор',
            'name'          => 'название',
            'description'   => 'описание',
            'createdAtFrom' => 'дата создания от',
            'createdAtTo'   => 'дата создания до',
            'pageSize'      => 'кол-во новостей на странице',
            'userLogin'     => 'login владельца',
        ];
    }

    /** @inheritdoc */
    public function init()
    {
        $this->pagination           = new Pagination();
        $this->pagination->pageSize = 10;
    }

    /**
     * получить отфильтрованные
     *
     * @return News[]
     */
    public function getFiltered()
    {
        $query = News::find();

        // фильтр по идентификатору
        $query->andFilterWhere(['id' => $this->id]);

        // фильтр по логину
        $query->andFilterWhere(['like', 'name', $this->name]);

        // фильтр по email
        $query->andFilterWhere(['like', 'description', $this->description]);

        // фильтр по дате созданию
        $query->andFilterWhere(['>=', 'createdAt', $this->createdAtFrom]);

        // фильтр по дате крайней аутентификации
        $query->andFilterWhere(['<=', 'createdAt', $this->createdAtTo]);

        // фильтр по идентификатору пользователя
        $query->leftJoin('user user', 'news.userId = user.id');
        $query->andFilterWhere(['user.login' => $this->userLogin]);

        $this->pagination->setPage($this->page - 1);
        $this->pagination->setPageSize($this->pageSize);
        $this->pagination->totalCount = $query->count();

        $query->limit($this->pagination->getLimit())->offset($this->pagination->getOffset());

        return $query->all();
    }
}