<?php defined('A') or die('Access denied');?>
<?php if (isset($options)): ?>
<label class="form-label"<?php if (isset($select_id)) {echo ' for="'.$select_id.'"';}?>><?php if (isset($select_title)) {echo $select_title;} if (isset($select_important)) {echo '<span class="red1">*</span>';} ?>:</label><br>
<select <?php if (isset($select_class)) {echo 'class="'.$select_class.'" ';} if (isset($disabled) and $disabled == true) {echo DISABLE;} if (isset($select_id)) {echo 'id="'.$select_id.'" ';} ?>name="<?=isset($select_name) ? $select_name : ''; ?>" <?php if (isset($readonly) and $readonly == true) {echo READONLY;} ?>size="1" target="_self"<?php if (isset($select_title)) {echo ' title="'.$select_title.'"';} ?>>
<?php foreach($options as $option): ?>
  <option <?php if (isset($disabled_id) and ($option['id'] === $disabled_id)) {echo DISABLE;} if (isset($selected_id) and ($option['id'] == $selected_id)) {echo SELECT;} ?>value="<?=$option['id'];?>"><?=$option['id'].'. '.$option['title'];?></option>
<?php endforeach; ?>
</select>
<?php endif; ?>