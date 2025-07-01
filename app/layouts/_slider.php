<?php defined('A') or die('Access denied');?>
<!-- Слайдер (начало) -->
<div class="carousel fade container-fluid" id="slider" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active" style="background-image: url(<?=D.I;?>slider/1.jpg);">
      <div class="carousel-caption">
        <h1>Заголовок слайда 1</h1>
        <p>Текст слайда 1</p>
      </div>
    </div>
    <div class="item" style="background-image: url(<?=D.I;?>slider/2.jpg);">
      <div class="carousel-caption">
        <h1>Заголовок слайда 2</h1>
        <p>Текст слайда 2</p>
      </div>
    </div>
    <div class="item" style="background-image: url(<?=D.I;?>slider/3.jpg);">
      <div class="carousel-caption">
        <h1>Заголовок слайда 3</h1>
        <p>Текст слайда 3</p>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#slider" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#slider" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>

    <!-- Indicators -->
  <div class="carousel-indicators-wrap">
  <ol class="carousel-indicators">
    <li data-target="#slider" data-slide-to="0" class="active"></li>
    <li data-target="#slider" data-slide-to="1"></li>
    <li data-target="#slider" data-slide-to="2"></li>
  </ol>
  </div>
  <div class="clearfix"></div>
</div>
<!-- Слайдер (конец) -->