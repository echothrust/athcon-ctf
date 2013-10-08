<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $nickname
 * @property string $team
 * @property string $category
 * @property string $passwd
 * @property string $mac
 * @property string $signature
 * @property string $TS
 *
 * The followings are the available model relations:
 * @property UsersTreasures[] $usersTreasures
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nickname, team, mac, signature, TS', 'required'),
			array('nickname, team, passwd', 'length', 'max'=>255),
			array('category', 'length', 'max'=>10),
			array('mac', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nickname, team, category, passwd, mac, signature, TS', 'safe', 'on'=>'search'),
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
			'usersTreasures' => array(self::HAS_MANY, 'UsersTreasures', 'users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nickname' => 'Nickname',
			'team' => 'Team',
			'category' => 'Category',
			'passwd' => 'Passwd',
			'mac' => 'Mac',
			'signature' => 'Signature',
			'TS' => 'Ts',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('team',$this->team,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('passwd',$this->passwd,true);
		$criteria->compare('mac',$this->mac,true);
		$criteria->compare('signature',$this->signature,true);
		$criteria->compare('TS',$this->TS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}