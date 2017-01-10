<?php
include_once('classes/helper.php');
include_once('classes/html.php');
include_once('classes/database.php');
session_start();
$db=new DB;
?>
<?php Html::head(); ?>
<?php Html::header(); ?>	
<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>
<div class="left-corner">
<h1>Магазины</h1>                                    
<div class="clear-block">
<div class="view view-stores view-id-stores view-display-id-page_1 view-dom-id-59cad420c3ef345c083878c5da547fa3">
      <div class="view-content">
      <div class="item-list">      <h3>Минск</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first">  
  <div class="views-field views-field-field-address-value">        пл. Ленина, 1  </div></li>
          <li class="views-row views-row-2 views-row-even views-row-last">  
  <div class="views-field views-field-field-address-value">        ул. Советская, 84, пом. 3  </div></li>
      </ul></div><div class="item-list">      <h3>Брест</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first views-row-last">  
  <div class="views-field views-field-field-address-value">        ул. Ленина, 64  </div></li>
      </ul></div><div class="item-list">      <h3>Витебск</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first">  
  <div class="views-field views-field-field-address-value">        ул. 50 лет ВЛКСМ, 33 (ТЦ &quot;Корона&quot;)  </div></li>
       
  </ul></div><div class="item-list">      <h3>Гомель</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first">  

  <div class="views-field views-field-field-address-value">        ул. Чонгарская, 67   </div></li>
    </ul></div><div class="item-list">      <h3>Гродно</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first">  

  <div class="views-field views-field-field-address-value">        ул. Комсомольская, 7   </div></li>
  </ul></div><div class="item-list">      <h3>Могилев</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first">  

  <div class="views-field views-field-field-address-value">        ул. Калинина, 12   </div></li>
      </ul></div><div class="item-list">      <h3>Санкт-Петербург</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first">  
  <div class="views-field views-field-field-address-value">        ул. Строителей, 26   </div></li>
          <li class="views-row views-row-2 views-row-even views-row-last">  
  <div class="views-field views-field-field-address-value">        ул. Чапаева, 4   </div></li>
      </ul></div><div class="item-list">      <h3>Киев</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first">  
  <div class="views-field views-field-field-address-value">        Варшавское шоссе, 11/1 (&quot;Евроопт&quot;)   </div></li>
          <li class="views-row views-row-2 views-row-even">  
  <div class="views-field views-field-field-address-value">        пр. Машерова, 46   </div></li>
          <li class="views-row views-row-3 views-row-odd">  
  <div class="views-field views-field-field-address-value">       ул. Буденного, 49   </div></li>
          <li class="views-row views-row-4 views-row-even views-row-last">  
  <div class="views-field views-field-field-address-value">        ул. Куйбышева, 13   </div></li>
      </ul></div><div class="item-list">      <h3>Москва</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first">  
  <div class="views-field views-field-field-address-value">        Бешенковичское шоссе, 3 (ТЦ &quot;Корона&quot;)   </div></li>
          <li class="views-row views-row-2 views-row-even">  
  <div class="views-field views-field-field-address-value">        пр. Московский, 9/1   </div></li>
          <li class="views-row views-row-3 views-row-odd">  
  <div class="views-field views-field-field-address-value">        пр. Строителей, 15   </div></li>
          <li class="views-row views-row-4 views-row-even">  
  <div class="views-field views-field-field-address-value">       пр. Строителей, 8/2   </div></li>
          <li class="views-row views-row-5 views-row-odd">  
  <div class="views-field views-field-field-address-value">        ул. Кирова, 2-43   </div></li>
          <li class="views-row views-row-6 views-row-even">  
  <div class="views-field views-field-field-address-value">        ул. Ленина, 48   </div></li>
          <li class="views-row views-row-7 views-row-odd views-row-last">  
  <div class="views-field views-field-field-address-value">        пр. Фрунзе, 58   </div></li>
      </ul></div><div class="item-list">      <h3>Варшава</h3>
    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first views-row-last">  
  <div class="views-field views-field-field-address-value">        ул. Ленина, 57, пом 3   </div></li>
      </ul></div>    </div>
</div></div>
</div> <!-- /.left-corner -->
</div> <!-- /.right-corner -->
</div> <!-- /#squeeze -->
</div> <!-- /#center -->
<div id="sidebar-left" class="sidebar">            
<?php Html::sidebar_menu($db->get_main_categories());?>		 
<?php Html::sidebar_articles($db->get_articles(2));?>
</div>
</div> <!-- /container -->
</div>
</div>
<?php Html::footer(); ?>
