<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $content_name
 * @property string $heading
 * @property string $sub_heading
 * @property string $small_content
 * @property string $large_content
 * @property string $banner_image
 * @property string $small_image
 * @property string $large_image
 * @property integer $sort_order
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $field1
 * @property integer $field2
 * @property integer $field3
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['small_content', 'large_content'], 'string'],
            [['sort_order', 'status', 'CB', 'UB', 'field1', 'field2', 'field3'], 'integer'],
            [['CB', 'UB','DOC', 'DOU'], 'safe'],
            [['content_name', 'heading', 'sub_heading', 'banner_image', 'small_image', 'large_image'], 'string', 'max' => 200],
            [['banner_image', 'small_image', 'large_image'], 'file','extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_name' => 'Content Name',
            'heading' => 'Heading',
            'sub_heading' => 'Sub Heading',
            'small_content' => 'Small Content',
            'large_content' => 'Large Content',
            'banner_image' => 'Banner Image',
            'small_image' => 'Small Image',
            'large_image' => 'Large Image',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'field1' => 'Field1',
            'field2' => 'Field2',
            'field3' => 'Field3',
        ];
    }
}
