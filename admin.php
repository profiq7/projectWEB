<?php
include_once('classes/helper.php');
include_once('classes/html.php');
include_once('classes/database.php');
session_start();
Helper::antirep();
$db=new DB;
if ($db->check_type_user($_SESSION['id'],$_SESSION['sk'])!=1)
{   header("Location: index.php");  
	exit;
}
?>

<?php Html::head(); ?>
<?php Html::header(); ?>	
<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>
<div class="left-corner">

<h1><?php Html::title_admin_form($_GET['t']);?></h1> 
                                   
<div class="clear-block">
<div id="quicktabs-ur" class="quicktabs_wrapper quicktabs-style-zen"><div id="quicktabs_container_ur" class="quicktabs_main quicktabs-style-zen"><div id="quicktabs_tabpage_ur_1" class="quicktabs_tabpage"><div class="user_register_wrapper form-1"><div class="form-2"><div class="form-3"><div class="form-4">
	  
<?php 
if ($_GET['t']=='categories')
{
	if (isset($_POST['cat1']))
	{
		for ($i=1; $i<=5; $i++)
			$c[$i]=Helper::init($_POST['cat'.$i]);
		$msg='';
		if ($db->add_main_category($c[1])) $msg='Категория добавлена.<br>';
		if ($db->add_sub_category($c[2],$c[3])) $msg.='Подкатегория добавлена.<br>';
		if ($db->change_category($c[4],$c[5])) $msg.='Категория изменена.<br>';
			
		if ($msg!='')
		{
			Html::success_message($msg);
			$_SESSION['rd']=1;
		}
		else Html::form_category($db->get_categories()); 
	}
	else Html::form_category($db->get_categories()); 
} 
else if ($_GET['t']=='articles')
{
	$c=array();
	if (isset($_POST['cat1']))
	{
		for ($i=1; $i<=4; $i++)
			$c[$i]=Helper::init($_POST['cat'.$i]);
		$msg='';
		if (Helper::isEmpty($c))
		{
			Html::error_message("Не указаны все данные");
			Html::form_article($c); 
		}
		else
		{
		    if ($db->add_article($c[1], $c[4], $c[3], $c[2]))  
			{	Html::success_message("Статья успешно добавлена");
				$_SESSION['rd']=1;
			} else 
			{
				Html::error_message("Системная ошибка");
			}
		}
	}
	else Html::form_article($c);
} if ($_GET['t']=='goods')
{
	$c=array();
	if (isset($_POST['cat1']))
	{
		for ($i=1; $i<=6; $i++)
			$c[$i]=Helper::init($_POST['cat'.$i]);
		$c[4]='-';
		$msg='';
		if (Helper::isEmpty($c))
		{
			Html::error_message("Не указаны все данные");
			Html::form_goods($c,$db->get_categories()); 
		} else if ($_FILES["cat4"]["size"] > 1024*3*1024)
		{
			Html::error_message("Размер фото более 3 Mb");
			Html::form_goods($c,$db->get_categories());
        } else if (!is_uploaded_file($_FILES["cat4"]["tmp_name"]))
		{
            Html::error_message("Не удалось загрузить фото на сервер");
			Html::form_goods($c,$db->get_categories());
		}
		else
		{
			$ar=explode(".",$_FILES["cat4"]["name"]);
            $c[4]="img/goods/".Helper::generateStr().'.'.$ar[count($ar)-1];

		    if ($db->add_goods($c))  
			{	Html::success_message("Товар успешно добавлен");
				move_uploaded_file($_FILES["cat4"]["tmp_name"], $c[4]);
				$_SESSION['rd']=1;
			} else 
			{
				Html::error_message("Системная ошибка");
			}
		}
	}
	else Html::form_goods($c,$db->get_categories());
}
?>

</div></div></div></div></div></div></div></div>                                
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
