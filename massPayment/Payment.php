<?
Yii::import('application.modules.massPayment.components.methods.*');

class Payment{
	protected $lpurse;	//кошелек пользователя
	
	public $idbalances;
	public $rpurse;		//кошелек владельца
	public $amount;
	public $iduser;
	public $transact_id;
	
	/**
	 * Создать объект класса
	 * @return object
	 */
	public static function build($className){
		return new $className;
	}
	
	/**
	 * Выставить признак выплаты
	 * @return bool
	 */
	protected function afterPay(){
		return MoneyBalance::model()->updateAll(array('state'=>1), "idbalance in ($this->idbalances)") ? true : false;
	}
	
	/**
	 * Получить дефолтный кошелек плательщика
	 * @return string
	 */
	public static function getDefaultLPurse($name){
		return Settings::model()->findbyattributes(array('name'=>$name))->value;
	}
	
	/**
	 * Получить номер wm_id
	 * @return string
	 */
	protected function getWmid(){
		return Wm::model()->findbyattributes(array('R'=>$this->lpurse))->wmid;
	}
	
	/**
	 * Получить путь к папке wm
	 * @return string
	 */
	protected function getFolder(){
		return Wm::model()->findbyattributes(array('R'=>$this->lpurse))->folder;
	}
	
	/**
	 * Получить сообщение с номером транзакции
	 * @return string
	 */
	protected function getMessage(){
		return 'Masspayment: '.$this->transact_id.' from advert.pro';
	}
	
	/**
	 * Получить имя класса для выплаты
	 * @param string $name
	 * @return string
	 */
	public static function getPayMethod($name){
		switch($name){
			case 'webmoney':  	 return 'WebmoneyAdapter';
			case 'yandex_money': return 'PayOutYandexAdapter';
			case 'qiwi': 		 return 'PayOutQiwiAdapter';
			case 'credit_card':  return 'PayOutCardAdapter';
			case 'llc':  		 return 'Llc';
		}
	}
}
?>