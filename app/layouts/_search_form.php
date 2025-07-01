<?php defined('A') or die('Access denied'); ?>
<!-- Форма поиска (начало) -->
<form action="<?=D.S;?>search" autocomplete="off" class="search_form form-inline" id="search_form" method="post" name="search">
<div class="form-group search_field">
<input class="search_input_text form-control typeahead" id="typeahead" name="search" maxlength="250" placeholder="Поиск по сайту" spellcheck="false" title="Введите Ваш поисковый запрос" type="text">
</div>
<input class="search_submit button" id="searchButton" name="search_submit" type="submit" value="Найти">
<!-- Токен для защиты от XSS -->
<!-- <input class="search" id="search_token" name="search_token" type="hidden" value="<?php if (isset($search_token)) {echo $search_token;}?>"> -->
</form>
<!-- Форма поиска (конец) -->