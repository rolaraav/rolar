<?php $this->pageTitle='Привлечённые партнёры - Панель партнёра' ?>

<div class="wrap">

    <h3>Аккаунт партнёра</h3>
    
    <?php define ('TRUSTEDP',$model->trusted); ?>


    <h1>Привлечённые Вами партнёры</h1>
    
    <?php $partners = $model->partners; ?>
    
    <?php if (empty ($partners)): ?>
    
       <p>Вы не привлекли пока что ни одного партнёра.</p>
       
    <?php else: ?>
    
    
    
    
<div class="items">

<table align="center" cellspacing="0">
<tr>
	<th width="45">Дата регистрации</th>
	<th width="110">RefID партнёра</th>
        <th>E-mail партнёра</th>        
    <th width="80">Число продаж</th>
    <th width="80">Ваш доход с партнёра</th>
</tr>


<?php foreach ($partners as $one): ?>

<?php $affs = $one->lev2; ?>

<?php $psum = 0; foreach ($affs as $it) {

   $psum += $it->pkomis;

} ?>

<tr>
	<td style="color:#036"><?= date ('j.m.Y H:i',$one->createTime); ?></td>
	<td><?= $one->id ?></td>
    <td><?= (TRUSTEDP==1)?$one->email:H::codemail ($one->email) ?></td>
    <td style="color:#090"><?= count ($affs); ?></td>
    <td style="color:#C00"><?= H::mysum ($psum) ?> р.</td>
</tr>

<?php endforeach; ?>
</table>
</div>    
    
    
    
    <?php endif; ?>

</div>