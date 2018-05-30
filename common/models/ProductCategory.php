<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id
 * @property string $category_name
 * @property string $big_image
 * @property string $small_image
 * @property string $big_content
 * @property string $small_content
 * @property integer $status
 * @property string $data_1
 * @property string $data_2
 * @property integer $data_3
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name','status'], 'required'],
            [['big_content', 'small_content'], 'string'],
            [['status', 'data_3', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['category_name', 'data_1', 'data_2'], 'string', 'max' => 50],
            [['big_image', 'small_image'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
            'big_image' => 'Big Image',
            'small_image' => 'Small Image',
            'big_content' => 'Big Content',
            'small_content' => 'Small Content',
            'status' => 'Status',
            'data_1' => 'Data 1',
            'data_2' => 'Data 2',
            'data_3' => 'Data 3',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
