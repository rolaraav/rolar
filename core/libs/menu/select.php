<option value="<?=$category['id'];?>"><?=$tab.$category['title'];?></option>
<?php
  if($category['alias'] == 'partner_products'):
    if(isset($this->partners)):
      foreach($this->partners as $partner): ?>
        <option value="<?=$partner['id'];?>"><?='&nbsp;'.$tab.'-'.$partner['title'];?></option>
      <?php endforeach;
    endif;
  endif;
  if(isset($category['childs'])): ?>
  <?=$this->getMenuHtml($category['childs'], '&nbsp;'.$tab.'-');?>
<?php endif; ?>