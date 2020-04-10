<?
Yii::import('application.modules.massPayment.components.methods.core.*');

class Llc extends Payment implements PaymentInterface{
	
	public function pay(){
		$this->lpurse = 'р/с';
		return parent::afterPay();
	}
}
?>