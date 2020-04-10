<?
Yii::import('application.modules.massPayment.components.methods.core.*');

class WebmoneyAdapter extends Payment implements PaymentInterface{
	
	function __construct(){
		$this->lpurse = parent::getDefaultLPurse('webmoney');
	}
	
	public function pay(){
		$wm = new Webmoney;
		$wm->wmid = parent::getWmid();
		$wm->folder = parent::getFolder();
		$result = $wm->WMXML2( $this->transact_id,	//номер внутренней транзакции
					$this->lpurse,		//кошелек отправителя
					$this->rpurse,		//кошелек получателя
					$this->amount,		//сумма
					0,			//срок протекции в днях
					'',			//код протекции
					parent::getMessage(),	//примечание перевода
					0,			//номер счета в системе WebMoney, по которому выполняется перевод
					1);			//признак, который определяет, будет ли выполнен перевод, если получатель запрещает входящие переводы
		
		return $result['retval']==0 ? parent::afterPay() : "Код ошибки: ".$result['retval']."<br>Расшифровка - ".$result['retdesc'];
	}
}
?>
