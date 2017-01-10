<?php
include_once('classes/helper.php');
include_once('classes/html.php');
include_once('classes/database.php');
session_start();
Helper::antirep();
$db=new DB;
?>

<?php Html::head(); ?>
<?php Html::header(); ?>	

<?php 
$error='';
if (isset($_POST['cat1']))
			{
				for ($i=1; $i<=2; $i++)
					$c[$i]=Helper::init($_POST['cat'.$i]);
				$msg='';
				if (Helper::isEmpty($c))
				{
					$error=1;
				}
				else
				{
					$res=$db->get_user($c);
					if ($res!='')  
					{	
						$_SESSION['sk']=Helper::generateStr();
						$_SESSION['id']=$res['id_user'];
						$db->set_sk($res['id_user'],$_SESSION['sk']);
						$_SESSION['rd']=1;
					} else 
					{
						$error=1;
					}
				}
			}
?>

<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>
                                <div class="left-corner">
                                    
<h1>Вход на сайт</h1>                                    
<div class="clear-block">
    <?php
			if (isset($_POST['cat1']))
			{
				if ($error=='')  
				{	
					Html::success_message("Вход выполнен");
				} 
				else 
				{
					Html::error_message("Вход запрещен");
					Html::form_entrance();
				}
			}
			else Html::form_entrance();
	?>	
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
