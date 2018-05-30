<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property integer $Slider_category
 * @property string $image
 * @property string $caption
 * @property string $sub_caption
 * @property string $readmore_link
 * @property integer $sort_order
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $field1
 * @property integer $field2
 * @property integer $field3
 * @property integer $field4
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Slider_category', 'sort_order', 'status', 'CB', 'UB', 'field1', 'field2', 'field3', 'field4'], 'integer'],
            [['caption', 'sub_caption'], 'string'],
            [['DOC', 'DOU', 'CB', 'UB'], 'safe'],
            [['image', 'readmore_link'], 'string', 'max' => 200],
            [['image'], 'file','extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Slider_category' => 'Slider Category',
            'image' => 'Image',
            'caption' => 'Caption',
            'sub_caption' => 'Sub Caption',
            'readmore_link' => 'Readmore Link',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'field1' => 'Field1',
            'field2' => 'Field2',
            'field3' => 'Field3',
            'field4' => 'Field4',
        ];
    }
}
