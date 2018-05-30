<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 */
class Contact extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['message', 'name', 'email', 'subject'], 'required'],
            [['message'], 'string'],
            [['email'], 'email'],
            [['name', 'email'], 'string', 'max' => 100],
            [['subject'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'subject' => 'Subject',
            'message' => 'Message',
        ];
    }

}
