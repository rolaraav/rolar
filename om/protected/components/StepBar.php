<?php


class StepBar
{
    /*
     * Показывает верхнюю строку шагов
     */
    static public function showBar ($num) {

        $bb = '<div class="wrap"><p align="center">';

        for ($i=1; $i<=5; $i++) {
            $pp = '_b';
            if ($i == $num) {
                $pp = '';
            }
            $bb .= '<img src="'.Y::bu().'images/front/order/step'.$i.$pp.'.png" class="step"> ';
        }

        $bb .= '</p></div>';

        return $bb;

    }

}


?>
