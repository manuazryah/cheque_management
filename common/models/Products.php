<?php

namespace common\models;

use Yii;
use common\models\ProductCategory;
/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $product_category
 * @property string $product_titile
 * @property string $sub_title
 * @property string $big_image
 * @property string $small_image
 * @property string $big_content
 * @property string $small_content
 * @property string $view_more_link
 * @property integer $status
 * @property string $data_1
 * @property string $data_2
 * @property integer $data_3
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['product_category', 'product_titile', 'big_image', 'big_content', 'small_content', 'view_more_link', 'status'], 'required'],
            [['product_category', 'status', 'data_3', 'CB', 'UB'], 'integer'],
            [['big_content', 'small_content'], 'string'],
            [['DOC', 'DOU'], 'safe'],
            [['product_titile', 'sub_title', 'big_image', 'view_more_link'], 'string', 'max' => 100],
            // [['big_image'], 'file','skipOnEmpty' => false, 'extensions' => 'jpg, gif, png'],
            // [['small_image'], 'file','skipOnEmpty' => TRUE, 'extensions' => 'jpg, gif, png'],
            [['data_1', 'data_2'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_category' => 'Product Category',
            'product_titile' => 'Product Titile',
            'sub_title' => 'Sub Title',
            'big_image' => 'Big Image',
            'small_image' => 'Small Image',
            'big_content' => 'Big Content',
            'small_content' => 'Small Content',
            'view_more_link' => 'View More Link',
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
    
     public function getCategories() {
                return $this->hasOne(ProductCategory::className(), ['id' => 'product_category']);
        }
}
