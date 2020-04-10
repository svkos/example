<?php

Yii::import('application.modules.massPayment.components.methods.core.*');

class PayOutCardAdapter extends Payment implements PaymentInterface{
	private $_gate;
	private $_service_id;
	
	function __construct(){
		$this->_gate = new PayOut();
		$this->_gate->setPoint('****');
		$this->_service_id = '****';
	}
	
	public function getProviders(){
		return $this->_gate->getProviders();
	}
	
	public function pay(){
		$payment = [
			'payment_id'    => $this->transact_id,
			'service_id'    => $this->_service_id,
			'fields'        => [ 				
				'visa_mc_qiwi_out_3.card' => $this->rpurse,
			],
			'amount'        => $this->amount,
			'data'          => strftime('%F %X', time()),
			'comment'       => parent::getMessage(),
		];

		$result = new SimpleXMLElement($this->_gate->createPayment($payment));
		return $result->action->payment['result']==0 ? true : $result->action->payment['message'];
	}
}
?>