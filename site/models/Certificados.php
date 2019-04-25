<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "certificados".
 *
 * @property string $chave
 * @property string $pdf
 */
class Certificados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'certificados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chave'], 'required'],
            [['pdf'], 'string'],
            [['chave'], 'string', 'max' => 100],
            [['chave'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'chave' => 'Chave',
            'pdf' => 'Pdf',
        ];
    }
}
