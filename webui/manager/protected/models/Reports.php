<?php

/**
 * This is the model class for table "reports".
 *
 * The followings are the available columns in table 'reports':
 * @property integer $id
 * @property integer $reporter
 * @property string $subject
 * @property string $attacker
 * @property string $server
 * @property string $abuse
 * @property string $message
 * @property string $logs
 * @property integer $resolved
 * @property string $thru
 * @property string $comments
 * @property string $mac
 */
class Reports extends CActiveRecord
{
    public $treasure_id;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reports the static model class
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
		return 'reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reporter, datentime, subject, attacker, server, abuse, message, logs', 'required'),
      array('reporter, resolved,treasure_id', 'numerical', 'integerOnly'=>true),
			array('subject, thru', 'length', 'max'=>255),
			array('attacker, server, abuse', 'length', 'max'=>32),
			array('mac', 'length', 'max'=>17),
			array('comments', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, reporter, datentime, subject, attacker, server, abuse, message, logs, resolved, thru, comments, mac', 'safe', 'on'=>'search'),
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
        'hacker'=>array(self::HAS_ONE, 'Users', 'mac'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'reporter' => 'Reporter',
       'datentime' => 'Date and Time',
			'subject' => 'Subject',
			'attacker' => 'Attacker',
			'server' => 'Server',
			'abuse' => 'Abuse',
			'message' => 'Message',
			'logs' => 'Logs',
			'resolved' => 'Resolved',
			'thru' => 'Thru',
			'comments' => 'Comments',
			'mac' => 'Mac',
      'treasure_id'=>'Achievement for Report',
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
        $criteria->compare('reporter',$this->reporter);
        $criteria->compare('datentime',$this->datentime);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('attacker',$this->attacker,true);
		$criteria->compare('server',$this->server,true);
		$criteria->compare('abuse',$this->abuse,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('logs',$this->logs,true);
		$criteria->compare('resolved',$this->resolved);
		$criteria->compare('thru',$this->thru,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('mac',$this->mac,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
  public static function add_blacklist($IP=null)
  {
     $connection= ssh2_connect('172.16.11.18', 22, array (
            'hostkey' => 'ssh-rsa'
        ));

        if (ssh2_auth_pubkey_file($connection, 'root', '/var/www/htdocs/id_rsa.pub', '/var/www/htdocs/id_rsa'))
            $stream= ssh2_exec($connection, "/sbin/pfctl -t blacklist -T add ".$IP.">/dev/null 2>&1");
        else {   $this->render('error', "SKATAAAAAAA"); }
  }

  public static function macItem()
  {
        $results = Yii::app()->db->createCommand('SELECT mac,inet_ntoa(ip) IP,timestamp FROM arphistory')->queryAll();
        $ret=null;
        foreach($results as $ah)
        {
            $ret[$ah['IP']][]=array($ah['mac'] => sprintf("%s - %s",$ah['IP'],$ah['timestamp'])); 
        }
       return $results;
    } 

  public static function treasureItem()
  {
        $results = Yii::app()->db->createCommand("SELECT id,name FROM treasures WHERE category='admin' and csum='ADMREPORTS'")->queryAll();
        $ret=null;
        foreach($results as $res)
            $ret[$res['id']]=$res['name'];
        return $ret;
    } 
}