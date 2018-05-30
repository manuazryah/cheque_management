<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "static_page".
 *
 * @property integer $id
 * @property string $main_image
 * @property string $sub_image
 * @property string $big_content
 * @property string $small_content
 * @property integer $status
 * @property string $viewmore_link
 * @property string $data_1
 * @property string $data_2
 * @property integer $data_3
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property string $title
 * @property string $sub_title
 */
class StaticPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_image', 'sub_image', 'big_content', 'small_content', 'status', 'viewmore_link', 'data_1', 'data_2', 'data_3', 'CB', 'UB', 'DOC', 'title', 'sub_title'], 'required'],
            [['big_content', 'small_content'], 'string'],
            [['status', 'data_3', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['main_image', 'sub_image'], 'string', 'max' => 100],
            [['viewmore_link', 'data_1', 'data_2', 'title', 'sub_title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_image' => 'Main Image',
            'sub_image' => 'Sub Image',
            'big_content' => 'Big Content',
            'small_content' => 'Small Content',
            'status' => 'Status',
            'viewmore_link' => 'Viewmore Link',
            'data_1' => 'Data 1',
            'data_2' => 'Data 2',
            'data_3' => 'Data 3',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'title' => 'Title',
            'sub_title' => 'Sub Title',
        ];
    }
}
