<?php
include_once('classes/helper.php');
include_once('classes/html.php');
include_once('classes/database.php');
session_start();

$db=new DB;
if ($db->check_type_user($_SESSION['id'],$_SESSION['sk'])!=1)
{   header("Location: index.php");  
	exit;
}
?>

<?php Html::head("Редактирование товара"); ?>
<?php Html::header(); ?>	
<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>
<div class="left-corner">

<h1>Редактирование товара</h1> 
                                   
<div class="clear-block">
<div id="quicktabs-ur" class="quicktabs_wrapper quicktabs-style-zen"><div id="quicktabs_container_ur" class="quicktabs_main quicktabs-style-zen"><div id="quicktabs_tabpage_ur_1" class="quicktabs_tabpage"><div class="user_register_wrapper form-1"><div class="form-2"><div class="form-3"><div class="form-4">
	  
<?php 
if (isset($_GET['id']))
{
	$id=Helper::init($_GET['id']);
	
	if (isset($_POST['cat1']))
	{
		$c=array();
		for ($i=1; $i<=6; $i++)
			$c[$i]=Helper::init($_POST['cat'.$i]);
		$c[4]='-';
		$msg='';
		$d=array();
		$d['title']=$c[1];
		$d['id_category']=$c[2];
		$d['price']=$c[3];
		$d['description']=$c[5];
		$d['bonus']=$c[6];
		$d['visible']=isset($_POST['cat7'])? 0 : 1;
		$c[7]=$d['visible'];
		$file=is_uploaded_file($_FILES["cat4"]["tmp_name"]);
		if (Helper::isEmpty($c))
		{
			Html::error_message("Не указаны все данные");
			Html::form_edit_goods($d,$db->get_categories()); 
		} else if ($file && $_FILES["cat4"]["size"] > 1024*3*1024)
		{
			Html::error_message("Размер фото более 3 Mb");
			Html::form_edit_goods($d,$db->get_categories());
        } 
		else
		{
			if ($file) // если файл фото загружен
			{
				$ar=explode(".",$_FILES["cat4"]["name"]);
				$c[4]="img/goods/".Helper::generateStr().'.'.$ar[count($ar)-1];
			} else
			{
				$x=$db->get_one_goods($id);
				$c[4]=$x['image'];
			}
			$c[0]=$id;
		    if ($db->update_edit_goods($c))  
			{	
				Html::success_message("Товар успешно изменен");
				if ($file)
					move_uploaded_file($_FILES["cat4"]["tmp_name"], $c[4]);
				$c=$db->get_one_goods($id);
				Html::form_edit_goods($c,$db->get_categories());
			} else 
			{
				Html::error_message("Системная ошибка");
				$c=$db->get_one_goods($id);
				Html::form_edit_goods($c,$db->get_categories());
			}
		}
	}
	else 
	{
		$c=$db->get_one_goods($id);
		Html::form_edit_goods($c,$db->get_categories());
	}
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
