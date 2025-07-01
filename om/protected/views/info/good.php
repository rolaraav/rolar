<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<title><?php echo $model->title; ?></title>

<link rel="stylesheet" type="text/css" href="<?=Y::bu();?>pg/files/style.css">

<script type="text/javascript" src="<?=Y::bu();?>pg/files/jquery.js"></script>
	<script src="<?=Y::bu();?>pg/files/number00.js"></script>
	<script src="<?=Y::bu();?>pg/files/script00.js"></script>
<script src="<?=Y::bu();?>js/galleria-1.2.9.min.js"></script>            

<style>
    #galleria{ width: 800px; height: 600px; background: #FFF }
</style>


</head>


<body>
    

    


<div class="bodi">

<!--HEADER-->

<div id="header">
    
    
<div class="logo"><a href=""></a><p style="padding-left: 30px;"><?=$model->title; ?></p><span style="padding-left: 30px;"><?=$model->dost; ?></span></div>



<div class="fone_block">
        <span class="fon_txt_1"><?=$model->phone; ?></span>

<p>&nbsp;</p>
</div>

</div>

<!--/HEADER-->



<!--TOP BLOCK-->

<div class="photo_block">

<a href="#" class="block_sale"><img src="<?=Y::bu (); ?>pg/files/hit_bg00.png" alt="" border="0"></a>

<div class="clearall"></div>

<div class="photo_rama"><img src="<?=Y::bu();?>pg/img/<?=$model->good_id; ?>/big_img.jpg" alt="" border="0"></div>

<div class="clearall"></div>

<div class="block_sum"><span class="b_s_txt_1"><?=$model->price; ?></span><span class="b_s_txt_2"><?=$model->currency; ?></span>

<p>старая цена: <span class="b_s_txt_3"><?=$model->oldprice; ?></span><?=$model->currency; ?></p></div>

</div>



<div class="txt_block">

<a name="order"></a>
<div class="akc_top">Внимание! Акция!</div>

<span class="akc_txt_1">Только</span><br> <span class="akc_txt_2">с <span class="old-date"></span> <span class="old-month"></span>до <span class="new-date"></span> <span class="new-month"></span></span><br>

<span class="akc_txt_3">Вы можете приобрести "<?=$model->title; ?>"</span><br>

<span class="akc_txt_1">всего за</span>  <span class="akc_txt_bg"><?=$model->price; ?><?=$model->currency; ?></span><br>

<span class="akc_txt_3">вместо <span class="akc_txt_4"><?=$model->oldprice; ?></span><?=$model->currency; ?>!</span> <span class="akc_txt_5">Экономия: <?=($model->oldprice-$model->price); ?><?=$model->currency; ?>!</span>

<span class="akc_txt_time">До конца акции осталось: <span class="akc_txt_time_hm"><span class="hours-end"></span>:<span class="minutes-end"></span></span><span class="akc_txt_time_s">:<span class="seconds-end"></span></span></span>



<form action="<?=Y::bu();?>/info/order" class="zayvka" method="post">

<div class="z_top"><span class="akc_txt_3">Оформите заказ заполнив форму ниже</span><div class="z_str"></div></div>

<div class="z_form_top"></div>

<div class="z_form_bg">

<div class="z_inp_1_bg"><input type="text" class="z_inp" name="uname" placeholder="Имя и Фамилия"></div>
<img src="<?=Y::bu(); ?>pg/files/name_img.jpg" alt="" border="0" class="incorrect-icon share1">
<img src="<?=Y::bu(); ?>pg/files/fone_img.jpg" alt="" border="0" class="correct-icon share1">

<input type="hidden" name="good_id" value="<?=$model->good_id; ?>">

<div class="z_inp_2_bg"><input type="text" class="z_inp" name="uphone" placeholder="Ваш номер телефона"><br>
</div> 
<img src="<?=Y::bu(); ?>pg/files/name_img.jpg" alt="" border="0" class="incorrect-icon share2">
<img src="<?=Y::bu(); ?>pg/files/fone_img.jpg" alt="" border="0" class="correct-icon share2">

<p align="left" style="padding: 5px 3px;">&nbsp;

</p>
<input type="submit" class="z_submit" value="Купить по акции!">

</div>

<div class="z_form_bottom"></div>

</form>

</div>

<!--/TOP BLOCK-->



<div class="clearall"></div>



<!--CONTENT-->

<div class="content_1"><div class="content_2"><div class="content_3">

<div class="lc" style="margin-top: -30px;">

<?php if (!empty ($model->video)): ?>
    
<iframe width="<?=$model->width;?>" height="<?=$model->height; ?>" src="http://www.youtube.com/embed/<?=$model->video; ?>?rel=0&showsearch=0" frameborder="0" allowfullscreen></iframe>

<?php endif; ?>


<h2><br><?=$model->zag1; ?> —</h2>
    
<p><?=$model->content;?></p>


</div>

<div class="rc" style="margin-top: -30px;">

<span class="rc_h2">О нас говорят:</span>

<div class="carousel-wrap">
	<ul class="comment_block">
	

        <?php for ($i=1; $i<=6; $i++): ?>
        
        <?php $myvar = 'otz'.$i;  $otz = $model->$myvar; if (empty ($otz)) continue; $otz2 = explode ('||',$otz); ?>
		
	<li>
	<div class="coment_ph"><img src="<?=Y::bu();?>pg/img/<?=$model->good_id;?>/otz<?=$i;?>.jpg" alt="" border="0"></div>
	<div class="coment_txt"><?=nl2br($otz2[0]); ?><span><?=$otz2[1]; ?></span></div>
	</li>
        
        <?php endfor; ?>
	
		
	<li style="border-bottom: 0">&nbsp;</li>

	</ul>
</div>

<a href="#" class="com_but">Еще отзывы</a>

</div>

<style type="text/css">

.thelist li {
    color: #444444;
    font-size: 16px;    
    list-style-image: url("/img/p/li.png");
    list-style-position: inside;
    margin-bottom: 15px;
    margin-left: 50px;
    text-align: left;        
}

.thelist h3 {
    padding-bottom: 7px;
    font-weight: normal;
    font-size: 24px;    
}

</style>

<p>&nbsp;</p>
<p>&nbsp;</p>

<div class="clearall"></div>

<div class="thelist">


<?php if (!empty ($model->block1)): ?>
<h3 align="center"><?=$model->block1; ?></h3>

<ul style="margin-left: 120px;">
    
        <?php $nlist = explode ("\n",$model->block1data); ?>
    
        <?php foreach ($nlist as $one): ?>
        <li><?=$one;?></li>
        <?php endforeach; ?>

    </ul>

<?php endif; ?>

<br>

<?php if (!empty ($model->block2)): ?>
<h3 align="center"><?=$model->block2; ?></h3>

<ul style="margin-left: 120px;">
    
        <?php $nlist = explode ("\n",$model->block2data); ?>
    
        <?php foreach ($nlist as $one): ?>
        <li><?=$one;?></li>
        <?php endforeach; ?>

    </ul>

<?php endif; ?>

<br>

<?php if (!empty ($model->block3)): ?>
<h3 align="center"><?=$model->block3; ?></h3>

<ul style="margin-left: 120px;">
    
        <?php $nlist = explode ("\n",$model->block3data); ?>
    
        <?php foreach ($nlist as $one): ?>
        <li><?=$one;?></li>
        <?php endforeach; ?>

    </ul>

<?php endif; ?>

</div>


<div class="clearall"></div>

<div class="cont_bottom">

<?=nl2br ($model->preorder); ?>

<br>

<a href="#" class="cont_but">Заказать сейчас!</a>

</div>



</div></div></div>

<!--/CONTENT-->

<br>

<center>    
<div id="galleria" align='center'>
    <?php for ($i=1;$i<=$model->imgcount;$i++): ?>
    <img src="<?=Y::bu();?>pg/img/<?=$model->good_id; ?>/<?=$i;?>.jpg">
    <?php endfor; ?>
    
</div>
</center>

<script type='text/javascript'>
    Galleria.loadTheme('<?=Y::bu();?>js/themes/classic/galleria.classic.min.js');    
    Galleria.configure({
        transition: 'fade',
        transitionSpeed: 50,
        imageCrop: true,
        overlayBackground: '#FFF',
    });    
    Galleria.run('#galleria');
</script>    




<!--WORK-->

<div class="w_h2">Как мы работаем?</div>

<div class="worc">

<div class="worc_block">

<a href="#"><img src="<?=Y::bu();?>pg/files/work_img.jpg" alt="" border="0"></a>

<p>Вы <span>оставляете заявку</span> на сайте или по телефону.</p>

</div>

<div class="worc_str"><img src="<?=Y::bu();?>pg/files/grin_sts.png" alt="" border="0"></div>

<div class="worc_block">

<a href="#"><img src="<?=Y::bu();?>pg/files/work_imh.jpg" alt="" border="0"></a>

<p>Наш менеджер, связывается с Вами для <span>подтверждения заказа.</span></p>

</div>

<div class="worc_str"><img src="<?=Y::bu();?>pg/files/grin_sts.png" alt="" border="0"></div>

<div class="worc_block">

<a href="#"><img src="<?=Y::bu();?>pg/files/work_imi.jpg" alt="" border="0"></a>

<p>Мы аккуратно <span>упаковываем товар и быстро доставляем</span> Вашу посылку в нужную точку.</p>

</div>

<div class="worc_str"><img src="<?=Y::bu();?>pg/files/grin_sts.png" alt="" border="0"></div>

<div class="worc_block">

<a href="#"><img src="<?=Y::bu();?>pg/files/work_imj.jpg" alt="" border="0"></a>

<p>Вы получаете товар и <span>платите за него в отделении</span> службы доставки в Вашем городе (также доступна предоплата).</p>

</div>

</div>

<!--/WORK-->



<div class="clearall"></div>



<!--VIGODA-->

<div class="v_h2">Почему покупать у нас выгодно?</div>



<div class="v_block">

<div class="v_img"><img src="<?=Y::bu();?>pg/files/wig_img_.png" alt="" border="0"></div>

<div class="v_txt">

<span class="v_t_h2">Низкие цены</span>

<p>Мы работаем напрямую с производителем, поэтому можем позволить себе акции и низкие цены.</p>

</div>

</div>



<div class="v_block">

<div class="v_img"><img src="<?=Y::bu();?>pg/files/wig_img0.png" alt="" border="0"></div>

<div class="v_txt">

<span class="v_t_h2">Гарантия качества</span>

<p>Если товар Вам не понравится, то пришлите его нам в аккуратном виде не позднее чем через 14 дней - и мы вернём деньги за товар.</p>

</div>
    
</div>



<div class="v_block">

<div class="v_img"><img src="<?=Y::bu();?>pg/files/wig_img1.png" alt="" border="0"></div>

<div class="v_txt">

<span class="v_t2_h2">Безопасность платежа</span>

<p>Вы платите за товар при получении - при этом до оплаты товар можно осмотреть. Что полностью исключает какой-либо риск.</p>

</div>

</div>



<div class="v_block">

<div class="v_img"><img src="<?=Y::bu();?>pg/files/wig_img2.png" alt="" border="0"></div>

<div class="v_txt">

<span class="v_t_h2">Оперативность</span>

<p>Мы не любим медлить и ценим Ваше время, поэтому работаем быстро. Отгрузим сегодня или завтра. Убедитесь в этом сами.</p>

</div>

</div>

<!--/VIGODA-->



<!--TIMER-->

<div class="t_h2">Последние часы специальной цены:</div>

<p class="t_txt"><span class="t_txt_of"><?=$model->oldprice; ?></span><?=$model->currency;?>, <span class="t_txt_bg">новая цена: <span class="t_txt_sum"><?=$model->price;?><?=$model->currency;?>!</span></span></p>



<div class="timer_block">

<div class="tim_block"></div>

<div class="tim_block"></div>

<div class="tim_bg"></div>

<div class="tim_block"></div>

<div class="tim_block"></div>

<div class="tim_bg"></div>

<div class="tim_block"></div>

<div class="tim_block"></div>

</div>



<div class="t_str"></div>

<a href="#order" class="tim_but">Заказать по акции!</a>

<!--/TIMER-->

<p>&nbsp;</p>

<div class="clearall"></div>


        <div align="center">

<?php if (!empty ($model->vkgroup)): ?>
            
<script type="text/javascript" src="http://vk.com/js/api/openapi.js?86"></script>
<div id="vk_groups2"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups2", {mode: 0, width: "600", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, <?=$model->vkgroup; ?>);
</script>

<?php endif; ?>

</div>



<!--FOOTER-->

<div class="footer"><div class="footer_bg_top">

        <div class="foott_txt">Ещё остались вопросы?<br><span>Звоните!</span></div>


<div class="foot_fone">

<span style="margin-top: 25px;" class="fon_txt"><?=$model->phone; ?></span>

<p><span class="f_t_big">&nbsp;</p>

</div>


<div class="clearall"></div>

<div class="foot_bott" style="font-size:12px;"><?=$model->footer; ?><br>
     </p></div>

</div></div>

<!--/FOOTER-->

 </div>

 <div class="bodi_f"></div>

</body>

</html>