<?php
include_once('classes/helper.php');
include_once('classes/html.php');
include_once('classes/database.php');
session_start();
$db=new DB;
?>

<?php Html::head("Поиск"); ?>
<?php Html::header(); ?>	
<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>
                                <div class="left-corner">
<?php 
	if (isset($_POST['search']) && trim($_POST['search'])!='')
	{
		$words=Helper::init($_POST['search']);
		$cat=isset($_POST['cat']) ? Helper::init($_POST['cat']) : 0;
		$gds=$db->get_search_goods($words, $cat);
	?>
		 <h1>Результат поиска "<?php echo $words;?>"</h1>
	
		      <div class="clear-block">
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
				<tr class="product_info">
				    <td class="product_info_td td_first">					
						<?php if (isset($gds[3])) Html::one_up_goods($gds[3]);?>
					</td>
					<td class="product_info_td">
						<?php if (isset($gds[4])) Html::one_up_goods($gds[4]);?>                                     
					</td>
					<td class="product_info_td td_last">
						<?php if (isset($gds[5])) Html::one_up_goods($gds[5]);?>
					</td>
				</tr>
				<tr class="product_links">
					<td class="product_links_td td_first">
						<?php if (isset($gds[3])) Html::one_down_goods($gds[3]['id_goods'],$gds[3]['price'],$db->get_rating_goods($gds[3]['id_goods'])); ?>
					</td>
					<td class="product_links_td">
						<?php if (isset($gds[4])) Html::one_down_goods($gds[4]['id_goods'],$gds[4]['price'],$db->get_rating_goods($gds[4]['id_goods'])); ?>
					</td>
					<td class="product_links_td td_last">
						<?php if (isset($gds[5])) Html::one_down_goods($gds[5]['id_goods'],$gds[5]['price'],$db->get_rating_goods($gds[5]['id_goods'])); ?>
					</td>
				</tr>
				<tr class="product_info">
				    <td class="product_info_td td_first">					
						<?php if (isset($gds[6])) Html::one_up_goods($gds[6]);?>
					</td>
					<td class="product_info_td">
						<?php if (isset($gds[7])) Html::one_up_goods($gds[7]);?>                                     
					</td>
					<td class="product_info_td td_last">
						<?php if (isset($gds[8])) Html::one_up_goods($gds[8]);?>
					</td>
				</tr>
				<tr class="product_links">
					<td class="product_links_td td_first">
						<?php if (isset($gds[6])) Html::one_down_goods($gds[6]['id_goods'],$gds[6]['price'],$db->get_rating_goods($gds[6]['id_goods'])); ?>
					</td>
					<td class="product_links_td">
						<?php if (isset($gds[7])) Html::one_down_goods($gds[7]['id_goods'],$gds[7]['price'],$db->get_rating_goods($gds[7]['id_goods'])); ?>
					</td>
					<td class="product_links_td td_last">
						<?php if (isset($gds[8])) Html::one_down_goods($gds[8]['id_goods'],$gds[8]['price'],$db->get_rating_goods($gds[8]['id_goods'])); ?>
					</td>
				</tr>
                            
                        </table>
        </div>
    </div>
</div>
	<?php
	} else if (isset($_POST['search']))
	{
		Html::error_message('Введите текст для поиска');
	}
?>
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
