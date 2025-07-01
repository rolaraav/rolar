<div class="wrap">
    
    <h3>Информация о статусах</h3>

<?=H::moredivAll ('информацию о статусах') ?>

<fieldset style="padding:15px;">
    
        <p><b>Информация о статусах для заказа</b><br>
            <span style="font-size:8px">(* помечены статусы, обзначающие уже реально оплаченные заказы)</span></p>                    
    
         <p>&nbsp;</p>                
             
         <p><img src="<?=Y::bu()?>images/status/waiting.gif" class="middle"> - пользователь начал оформлять заказ (всего лишь заполнил форму)</p><br>
         <p><img src="<?=Y::bu()?>images/status/approved.gif" class="middle"> - * полностью оплаченный счёт за товар</p><br>         
         <p><img src="<?=Y::bu()?>images/status/processing.gif" class="middle"> - * пользователь оплатил физический товар предварительно, но товар ещё не отправлен</p><br>
         <p><img src="<?=Y::bu()?>images/status/sent.gif" class="middle"> - * покупателю физический товар (оплаченный предварительно) - уже отправлен</p><br>
         <p><img src="<?=Y::bu()?>images/status/nalozh.gif" class="middle"> - выбран наложенный платёж, но заказ ещё не подтверждён по e-mail/телефону</p><br>
         <p><img src="<?=Y::bu()?>images/status/nalozh_confirmed.gif" class="middle"> - пользователь подтвердил заказ наложенным платежом, но товар ещё не отправлен</p><br>
         <p><img src="<?=Y::bu()?>images/status/nalozh_sent.gif" class="middle"> - заказ наложенным платежом отправлен пользователю, оплата за него ожидается</p><br>        
         <p><img src="<?=Y::bu()?>images/status/nalozh_ok.gif" class="middle"> - * поступила оплата за заказ наложенным платежом</p><br>        
         <p><img src="<?=Y::bu()?>images/status/nalozh_back.gif" class="middle"> - покупатель не выкупил на почте товар, заказанный наложенным платежом (возврат)</p><br>                 
         <p><img src="<?=Y::bu()?>images/status/cancelled.gif" class="middle"> - неправильно оформленный и неоплаченный заказ отменён оператором или пользователем</p><br>                         

             <p>&nbsp;</p>
    
</fieldset>

</div>

</div>