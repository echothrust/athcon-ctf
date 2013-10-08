<?php

/**
 * This is the model class for table "hint".
 *
 * The followings are the available columns in table 'hint':
 * @property string $id
 * @property string $usertype
 * @property string $message
 */
class Hint extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hint the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hint';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usertype, message', 'required'),
      array('usertype', 'length', 'max'=>6),
      array('category', 'length', 'max'=>10),
      array('title', 'length', 'max'=>255),
			array('message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, usertype, category, message', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
      'usertype' => 'Hint for type',
      'category' => 'Hint Category',
			'message' => 'Message',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
    $criteria->compare('title',$this->title,true);
    $criteria->compare('usertype',$this->usertype,true);
    $criteria->compare('category',$this->category,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  public static function enumItem($model,$attribute)
  {
       $attr=$attribute;
      //self::resolveName($model,$attr);
       preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
            foreach(explode(',', $matches[1]) as $value)
            {
                    $value=str_replace("'",null,$value);
                    $values[$value]=Yii::t('enumItem',$value);
            }
            
            return $values;
    }       
}