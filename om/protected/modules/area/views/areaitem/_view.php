<fieldset style="padding:10px;">



<p><img src="<?=Y::bu()?>images/area_icons/<?=$data->icon?>" style="float:left; padding:5px 25px"></p>

    <b>Название файла:</b> <?= CHtml::encode($data->title); ?></p>
<p><b>Описание:</b> <?=$data->description ?></p>

<br>
<p><b>Загружен:</b> <span class="thedate"><?=date ('j.m.Y',$data->uploadDate); ?></span></p>
<p align="right"><a href="<?=Y::bu()?>area/areaitem/download/id/<?=$data->id?>/file/<?=CHtml::encode($data->filename)?>">Скачать (<?= $data->size ?>)</a></p>

<br />

</fieldset>

<br />