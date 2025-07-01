<?php

class FController extends Controller{

	public function actionFail($w = FALSE) {
		$this->render('fail');
	}

	public function actionOk($w = FALSE) {
		$this->render('ok');
	}

	public function actionOrder($w = FALSE)	{
		$this->render('order');
	}

	public function actionWait($w = FALSE) {
		$this->render('wait');
	}

}