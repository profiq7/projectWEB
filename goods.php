<?php
include_once('classes/helper.php');
include_once('classes/html.php');
include_once('classes/database.php');
session_start();
$db=new DB;
Helper::add_to_cart();
?>

<?php Html::head("Товары"); ?>
<?php Html::header(); ?>	
<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>
<div class="left-corner">

<?php if (isset($_GET['id'])) { 
	 Html::one_full_goods($db->get_one_goods(Helper::init($_GET['id'])),$db->check_type_user($_SESSION['id'],$_SESSION['sk']));
} else if (isset($_GET['cat'])) { 
	$b=isset($_GET['b']) ? Helper::init($_GET['b']) : 0; // вид товара (акции, хиты, новинки) 0,1,2,3
	$s=isset($_GET['s']) ? Helper::init($_GET['s']) : 0; // вид сортировки (по id(0), по цене(2), по названию(1)) 0,1,2
	$p=isset($_GET['p']) ? Helper::init($_GET['p']) : 0; // номер страницы 0 - [count/9]
	$c=Helper::init($_GET['cat']);                       // id категории товаров
	$cat=$db->get_category($c);
	$count=$db->get_count_goods($c,$b);
	$gds=$db->get_goods($c,$b,$p,$s); 
?>
	 <h1><?php echo $cat['category'];?></h1>                                    
      <div class="clear-block">
        <div class="catalog-page">
		
		<?php Html::sort_menu($c,$b,$s); ?>
        <?php Html::pager($count,$c,$b,$s,$p); ?>
		 
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

        <?php Html::pager($count,$c,$b,$s,$p); ?>
    </div>
</div>
<?php } ?>							
</div> 
</div> 
</div> 
</div> 
<div id="sidebar-left" class="sidebar">           
<?php 
if (!isset($_GET['cat'])) 
	Html::sidebar_menu($db->get_main_categories()); 
else 
{
	$cat=Helper::init($_GET['cat']);
	if ($db->is_main_cat($cat)) 
	{
	    if ($db->has_sub_categories($cat))
		{
			Html::sidebar_menu($db->get_main_categories(),$cat,$db->get_sub_categories($cat)); 
		}
		else
		{
			Html::sidebar_menu($db->get_main_categories(),$cat);
		}
	}
	else 
	{
		$main_cat=$db->get_parent_cat($cat);
		Html::sidebar_menu($db->get_main_categories(),$main_cat,$db->get_sub_categories($main_cat),$cat); 
	}
}?>		 
<?php Html::sidebar_articles($db->get_articles(2));?>
</div>
</div> 
</div>
</div>			
<?php Html::footer(); ?>
