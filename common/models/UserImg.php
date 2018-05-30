<?php

namespace common\models;

use Yii;
use karpoff\icrop\CropImageUploadBehavior;

/**
 * This is the model class for table "user_img".
 *
 * @property integer $id
 * @property string $image
 */
class UserImg extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'user_img';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			['image', 'file', 'extensions' => 'jpeg, gif, png', 'on' => ['insert', 'update']],
			[['photo_crop', 'photo_cropped'], 'string', 'max' => 100]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'image' => 'Image',
		];
	}

	function behaviors() {
		return [
			[
			'class' => CropImageUploadBehavior::className(),
			'attribute' => 'image',
			'scenarios' => ['insert', 'update'],
			'path' => '@webroot/uploads/images',
			'url' => '@web/upload/images',
			'ratio' => 1.2,
			'crop_field' => 'photo_crop',
			'cropped_field' => 'photo_cropped',
		    ],
		];
	}

}
