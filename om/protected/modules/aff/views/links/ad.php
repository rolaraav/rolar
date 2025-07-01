<?php $this->pageTitle='Рекламные материалы - Панель партнёра' ?>

<div class="wrap">

    <h3>Аккаунт партнёра</h3>

    <h1>Рекламные материалы</h1>

<?php if (!(empty($good->ads))): ?>

    <?php echo Ad::repl($good->ads,Yii::app()->user->id,$good->id); ?>

<?php else: ?>
    
    
<?php if (count($adc)<1): ?>

<p><i>В данное время дополнительные рекламные материалы - отсутствуют</i></p>

<?php else: ?>

<?php $adn = array (); ?>

<?php

  foreach ($adc as $cat=>$item) {
  
    $aa = '';
    
    foreach ($item as $banner) {
    
        $aa .= '<p><b><span style="font-size:16px; color:#003366">'.$banner->title.'</span></b></p>';
        
        $aa .= '<br><p>' . Ad::repl($banner->code,Yii::app()->user->id,$good->id) . '</p>';

        if ($banner->showcode > 0) {
        
            $aa .= '<br><p><b>HTML-Код:</b><br><br><textarea cols="60" rows="7" class="textarea" >' . Ad::repl($banner->code,Yii::app()->user->id,$good->id) . '</textarea></p>';
        
        }
                
        $aa .= '<p>&nbsp;</p>';
        
                
    }
    $adn[$cat] = $aa;
  
  }
  
?>


<?php $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs'=>$adn,
        'htmlOptions' => array ('class' => 'tabs','style' => 'border:0'),
      )
   ); ?>

<?php endif; ?>

<?php endif; ?>

</div>