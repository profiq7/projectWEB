<?php
include_once('classes/helper.php');
include_once('classes/html.php');
include_once('classes/database.php');
session_start();

$db=new DB;

Helper::logout($db); // обработка выхода пользователя из кабинета
Helper::add_to_cart(); // обновление корзины
?>

<?php Html::head(); ?>
<?php Html::header(); ?>	
<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>

<div class="left-corner">
   <div class="clear-block"></div>
		<div class="content_bottom">
           <?php Html::main_slider(); ?>             

<div id="block-mts-1" class="clear-block block block-mts">
<div class="block-inner">
  <h2>Специальные предложения</h2>
  <?php $gds=$db->get_rand_goods(3, 3); ?>
	 <div class="content">
		<div class="catalog-page">
		<div class="content">
			<table class="catalog-table">
				<tr class="product_info">
				    <td class="product_info_td td_first">					
						<?php if (isset($gds[0])) Html::one_up_goods($gds[0]);?>
					</td>
					<td class="product_info_td">
						<?php if (isset($gds[1])) Html::one_up_goods($gds[1]);?>                                     
					</td>
					<td class="product_info_td td_last">
						<?php if (isset($gds[2])) Html::one_up_goods($gds[2]);?>
					</td>
				</tr>
				<tr class="product_links">
					<td class="product_links_td td_first">
						<?php if (isset($gds[0])) Html::one_down_goods($gds[0]['id_goods'],$gds[0]['price'],$db->get_rating_goods($gds[0]['id_goods'])); ?>
					</td>
					<td class="product_links_td">
						<?php if (isset($gds[1])) Html::one_down_goods($gds[1]['id_goods'],$gds[1]['price'],$db->get_rating_goods($gds[1]['id_goods'])); ?>
					</td>
					<td class="product_links_td td_last">
						<?php if (isset($gds[2])) Html::one_down_goods($gds[2]['id_goods'],$gds[2]['price'],$db->get_rating_goods($gds[2]['id_goods'])); ?>
					</td>
				</tr>
			</table>
		</div>
		</div>
	</div>
</div>
</div>


<div id="block-mts-1" class="clear-block block block-mts">
<div class="block-inner">
  <h2>Новинки</h2>
   <?php $gds=$db->get_rand_goods(3, 1); ?>
	 <div class="content">
		<div class="catalog-page">
		<div class="content">
			<table class="catalog-table">
				<tr class="product_info">
				    <td class="product_info_td td_first">					
						<?php if (isset($gds[0])) Html::one_up_goods($gds[0]);?>
					</td>
					<td class="product_info_td">
						<?php if (isset($gds[1])) Html::one_up_goods($gds[1]);?>                                     
					</td>
					<td class="product_info_td td_last">
						<?php if (isset($gds[2])) Html::one_up_goods($gds[2]);?>
					</td>
				</tr>
				<tr class="product_links">
					<td class="product_links_td td_first">
						<?php if (isset($gds[0])) Html::one_down_goods($gds[0]['id_goods'],$gds[0]['price'],$db->get_rating_goods($gds[0]['id_goods'])); ?>
					</td>
					<td class="product_links_td">
						<?php if (isset($gds[1])) Html::one_down_goods($gds[1]['id_goods'],$gds[1]['price'],$db->get_rating_goods($gds[1]['id_goods'])); ?>
					</td>
					<td class="product_links_td td_last">
						<?php if (isset($gds[2])) Html::one_down_goods($gds[2]['id_goods'],$gds[2]['price'],$db->get_rating_goods($gds[2]['id_goods'])); ?>
					</td>
				</tr>
			</table>
		</div>
		</div>
	</div>
</div>
</div>  
  
<div id="block-mts-1" class="clear-block block block-mts">
<div class="block-inner">
  <h2>Хиты продаж</h2>
   <?php $gds=$db->get_rand_goods(3, 2); ?>
	 <div class="content">
		<div class="catalog-page">
		<div class="content">
			<table class="catalog-table">
				<tr class="product_info">
				    <td class="product_info_td td_first">					
						<?php if (isset($gds[0])) Html::one_up_goods($gds[0]);?>
					</td>
					<td class="product_info_td">
						<?php if (isset($gds[1])) Html::one_up_goods($gds[1]);?>                                     
					</td>
					<td class="product_info_td td_last">
						<?php if (isset($gds[2])) Html::one_up_goods($gds[2]);?>
					</td>
				</tr>
				<tr class="product_links">
					<td class="product_links_td td_first">
						<?php if (isset($gds[0])) Html::one_down_goods($gds[0]['id_goods'],$gds[0]['price'],$db->get_rating_goods($gds[0]['id_goods'])); ?>
					</td>
					<td class="product_links_td">
						<?php if (isset($gds[1])) Html::one_down_goods($gds[1]['id_goods'],$gds[1]['price'],$db->get_rating_goods($gds[1]['id_goods'])); ?>
					</td>
					<td class="product_links_td td_last">
						<?php if (isset($gds[2])) Html::one_down_goods($gds[2]['id_goods'],$gds[2]['price'],$db->get_rating_goods($gds[2]['id_goods'])); ?>
					</td>
				</tr>
			</table>
		</div>
		</div>
	</div>
</div>
</div>

                      </div>
                                    
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

