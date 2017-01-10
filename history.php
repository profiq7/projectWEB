<?php
include_once('classes/helper.php');
include_once('classes/html.php');
include_once('classes/database.php');
session_start();
$db=new DB;

$user=$db->get_user_info($_SESSION['id'],$_SESSION['sk']); // проверка уровня доступа ползователя
$user['password']='';
if ($user=='' || $user['type']==3) // запрет, если анонимный ползователь или заблокированный
{
	header("Location: index.php");  
	exit;
}
?>

<?php Html::head(); ?>
<?php Html::header(); ?>	
<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>
<div class="left-corner">
<?php if (!isset($_GET['t'])) { ?>
		<h1>История заказов</h1>                                    
		<div class="clear-block">
		<?php 
		if ($user['type']==2) { // если авторизованный клиент
			$ords=$db->get_orders($user['id_user']);
		?>
			<table class="uc-order-history sticky-enabled">
			<thead><tr><th>Код заказа и клиент</th><th>Товары</th><th><div class="cart-total">Стоимость</div></th><th>Статус</th> </tr></thead>
			<tbody>
			 
			 <?php if ($ords=='') { ?>
				 <tr class="odd">
					<td colspan="5">Пока нет заказов.</td>
				 </tr>
			<?php } else {
				foreach ($ords as $ord) {
				?>
					 <tr class="odd">
						<td><?php echo $ord['id_order'];?></td>
						<td><?php
							foreach ($ord['goods'] as $gd) 
							{
								echo '<a href="goods.php?id='.$gd['id_goods'].'">'.$gd['title'].'</a>('.$gd['count'].' шт)<br>';
							}
						?></td>
						<td><?php echo $ord['price'];?> р</td>
						<td><?php echo Helper::int_to_status_order($ord['status']);?></td>
					</tr>
				<?php
				} ?>
			<?php } ?>
			
			</tbody>
			</table>
		<?php } else { // история покупок для админа 
				 if (isset($_GET['o'])) // конкретный заказ (id_order)
				 { 
					if (isset($_POST['type']))
					{
						$db->update_status_order(Helper::init($_GET['o']),Helper::init($_POST['type']));
					}
					$data=$db->get_one_order(Helper::init($_GET['o']));
					Html::form_admin_order($data);
				 } else // все заказы
				 {
					$ords=$db->get_all_orders();
					?>
						<table>
						<thead><tr><th>Код заказа и клиент</th><th>Товары</th><th>Стоимость</th><th>Статус</th> </tr></thead>
						<tbody>
						 
						 <?php if ($ords=='') { ?>
							 <tr>
								<td colspan="5">Пока нет заказов.</td>
							 </tr>
						<?php } else {
							foreach ($ords as $ord) {
							?>
								 <tr class="odd">
									<td><?php echo 'Заказ '.$ord['id_order'].'<br><a href="history.php?t='.$ord['id_user'].'">'.$ord['name'].'</a>';?></td>
									<td><?php
										foreach ($ord['goods'] as $gd) 
										{
											echo '<a href="goods.php?id='.$gd['id_goods'].'">'.$gd['title'].'</a>('.$gd['count'].' шт)<br>';
										}
									?></td>
									<td><?php echo $ord['price'].' p<br><a href="history.php?o='.$ord['id_order'].'">Смотреть заказ</a>';?></td>
									<td><?php echo Helper::int_to_status_order($ord['status']);?></td>
								</tr>
							<?php
							} ?>
						<?php } ?>
						
						</tbody>
						</table>
					<?php
				 }
		 } ?>
		</div>
<?php } else { // данные пользователя (isset($_GET['t']))

		if ($user['type']==2) {
				if (!isset($_POST['email'])) {
					Html::form_user($user); 
				} else
				{
					$data=array();
					$data['name']=$user['name'];
					$data['surname']=$user['surname'];
					$data['birth']=$user['birth'];
					$data['email']=Helper::init($_POST['email']);
					$data['phone']=Helper::init($_POST['phone']);
					$data['password']=Helper::init($_POST['password']);
					$data['password2']=Helper::init($_POST['password2']);
					$data['id_user']=$user['id_user'];
					
					$msg='';
					if ($data['email']=='')
					{
						$msg='Не указан email';
					} else if ($data['phone']=='')
					{
						$msg='Не указан телефон';
					} else if (($data['password']!='' && $data['password']!=$data['password2']) ||
					($data['password2']!='' && $data['password']!=$data['password2']))
					{
						$msg='Пароли не совпадают';
						$data['password']='';
						$data['password2']='';
					}
					
					if ($msg!='')
					{
						Html::error_message($msg);
						Html::form_user($data);
					}
					else
					{
						if ($db->update_user($data))
						{
							Html::success_message('Данные изменены');
						}
						else
						{
							Html::error_message('Системная ошибка');
						}
					}
				}
		} else { // данные пользователя для админа t=0 - все, иначе id_user
			
			$t=Helper::init($_GET['t']);
			if ($t==0) // показ списка пользователей
			{
				$users=$db->get_users();
				?>
					<table>
					<thead><tr><th>Номер</th><th>ФИО</th><th><div class="cart-total">Информация</div></th><th>Статус</th> </tr></thead>
					<tbody>
					 
					 <?php if ($users=='') { ?>
						 <tr class="odd">
							<td colspan="5">Пользователей нет.</td>
						 </tr>
					<?php } else {
						foreach ($users as $usr) {
						?>
							 <tr class="odd">
								<td><?php echo $usr['id_user'];?></td>
								<td><?php
									echo '<a href="history.php?t='.$usr['id_user'].'">'.$usr['name'].' '.$usr['surname'].'</a>';
								?></td>
								<td><?php echo $usr['email'].' '.$usr['phone'];?></td>
								<td><?php echo Helper::int_to_status_user($usr['type']);?></td>
							</tr>
						<?php
						} ?>
					<?php } ?>
					
					</tbody>
					</table>
					<?php
			}
			else
			{
				$usr=$db->get_one_user($t);
				$usr['orders']=$db->get_orders_by_user($t);
				Html::form_admin_user($usr);
			}
	
		}
 } ?>
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
