<?php
<?php
include_once('classes/helper.php');
include_once('classes/html.php');
include_once('classes/database.php');
session_start();
$db=new DB;
Helper::antirep();
Helper::refresh_cart();
?>

<?php Html::head("Заказ товаров"); ?>
<?php Html::header(); ?>	
<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>
<div class="left-corner">

<?php if (!isset($_POST['order']) && !isset($_POST['finish'])) { ?>
    <div class="cart-outer-wrapper">
		<h1>Корзина</h1> 
<?php if (isset($_SESSION['count_cart']) && $_SESSION['count_cart']>0) {?>		
			<div class="clear-block">
                <div id="cart-form-pane">
					
					<form action="" method="POST" id="rform" name="rform"></form>
					<form action=""  accept-charset="UTF-8" method="post" id="uc-cart-view-form">
					<div>
					<div id="cart-form-products">
					<table width="100%" class="sticky-enabled">
						<thead><tr><th>Название</th><th><div class="cart-total">Стоимость</div></th> </tr></thead>
					<tbody>
						<?php 
							$_SESSION['total_price']=0;
							foreach ($_SESSION['goods'] as $id=>$count)
							{
								$gd=$db->get_one_goods(Helper::init($id));
								$gd['count']=$count;
								$_SESSION['total_price']+=$gd['count']*$gd['price'];
								Html::row_cart($gd);
							}
						?>
						<tr class="even">
							<td class="td-subtotal-title"><div id="subtotal-title">Итого:</div></td>
							<td class="td-subtotal-price">
								<div class="subtotal-price"><span class="uc-price"><?php echo $_SESSION['total_price'];?> руб.</span></div></td><td class="td-subtotal-empty">
							</td>
							<td class="td-subtotal-empty">
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div id="cart-form-buttons">
					<input type="submit" form="rform" name="r" id="edit-update" value="1"  class="form-submit" /> 
					<input type="hidden" name="order" id="edit-update" value="order"  class="form-submit" /> 
					<input type="submit" name="op" id="edit-checkout" value="Оформление заказа"  class="form-submit" />
				</div>
				</div>
					</form>
				</div>
				</div>

	<?php if (!isset($_SESSION['sk'])) { ?>
		<div class="login-reg">
			<p>Уважаемый пользователь, предлагаем вам <a href="entrance.php">авторизоваться</a> или <a href="reg.php">зарегистрироваться</a> для дальнейшей более удобной работы с интернет-магазином</p>
		</div>
	<?php } ?>

<?php } else { ?>
	<p>В корзине нет товаров</p>
<?php } ?>
  </div><!-- /.cart-outer-wrapper -->	
<?php } else if (isset($_POST['order']) || isset($_POST['finish'])) { ?>
<div class="cart-outer-wrapper">
     <h1>Оформление заказа</h1>                                    
    <?php 
	 if (isset($_POST['cat1'])) 
	 {
		$c=array();
		for ($i=1; $i<=9; $i++)
			$c[$i]=Helper::init($_POST['cat'.$i]);
		$msg='';
		if (Helper::areEmpty($c,array(2,4,6,7,8)))
		{
			Html::error_message("Не указаны все данные");
			Html::form_order(Helper::createOrder($c)); 
		}
		else
		{
			if (empty($c[1])) $c[1]=' ';
			if (empty($c[3])) $c[3]=' ';
			if (empty($c[5])) $c[5]=' ';
			if (empty($c[9])) $c[9]=' ';
			
			$user=$db->get_user_info($_SESSION['id'],$_SESSION['sk']);
			if ($user=='')
			{
				$user=array();
				$user['id_user']=0;
			}
			
		    if ($db->add_order(Helper::createOrder($c),$_SESSION['goods'], $user['id_user']))
			{
				Html::success_message("Заказ успешно оформлен.<br>В ближайнее время наш менеджер свяжется с Вами.");
				unset($_SESSION['count_cart']);
				unset($_SESSION['goods']);
				unset($_SESSION['total_price']);
				$_SESSION['rd']=1;
			} 
			else 
			{
				Html::error_message("Системная ошибка");
			}
		}
	 }
	 else
	 {
		$data=$db->get_user_info($_SESSION['id'],$_SESSION['sk']);
		if ($data=='')
			$data=array();
		Html::form_order($data);
	 }
	
	?>  
	
	
	<?php if (!isset($_SESSION['sk'])) { ?>
		<div class="login-reg">
			<p>Уважаемый пользователь, предлагаем вам <a href="entrance.php">авторизоваться</a> или <a href="reg.php">зарегистрироваться</a> для дальнейшей более удобной работы с интернет-магазином</p>
	   </div>
	<?php } ?>
</div><!-- /.cart-outer-wrapper -->
<?php } ?>  
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
