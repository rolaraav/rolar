<?php
/**
 * NCaptcha class file.
 *
 */


class MyCCaptchaAction extends CCaptchaAction
{

	/**
	 * Generates a new verification code.
	 * @return string the generated verification code
	 */
	protected function generateVerifyCode()
	{
		if($this->minLength < 3)
			$this->minLength = 3;
		if($this->maxLength > 20)
			$this->maxLength = 20;
		if($this->minLength > $this->maxLength)
			$this->maxLength = $this->minLength;
		$length = mt_rand($this->minLength,$this->maxLength);

		$code = '';

		for($i = 0; $i < $length; ++$i)
		{
				$code .= mt_rand(0,9);
		}

		return $code;
	}

}