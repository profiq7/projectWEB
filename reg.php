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
<?php Html::main_menu( isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0, $db->get_user_info($_SESSION['id'],$_SESSION['sk'])); ?>
                                 <div class="left-corner">
                                  <h1>Регистрация</h1>                                    
                                    <div class="clear-block">
      <div id="quicktabs-ur" class="quicktabs_wrapper quicktabs-style-zen"><div id="quicktabs_container_ur" class="quicktabs_main quicktabs-style-zen"><div id="quicktabs_tabpage_ur_1" class="quicktabs_tabpage"><div class="user_register_wrapper form-1"><div class="form-2"><div class="form-3"><div class="form-4">
	  
	  <?php
			if (isset($_POST['cat1']))
			{
				for ($i=1; $i<=11; $i++)
					$c[$i]=Helper::init($_POST['cat'.$i]);
				$msg='';
				if ($c[4]=='') $c[4]=' ';
				if (Helper::isEmpty($c))
				{
					Html::error_message("Не указаны все данные");
					Html::form_reg($c); 
				}
				else if (!isset($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !== $c[11])
				{
					$c[11]='';
					Html::error_message("Неверные символы с картинки");
					Html::form_reg($c); 
				} 
				else if ($c[9]!==$c[10])
				{
					$c[9]='';
					$c[10]='';
					Html::error_message("Пароли не совпадают");
					Html::form_reg($c); 
				}
				else if (strlen($c[9])<5)
				{
					$c[9]=''; $c[10]='';
					Html::error_message("Пароль должен содержать не менее 5 символов");
					Html::form_reg($c);
				}
				else if (!filter_var($c[1], FILTER_VALIDATE_EMAIL) || $db->exists_email($c[1]))
				{
					$c[1]='';
					Html::error_message("Данный email недопустим");
					Html::form_reg($c); 
				}
				else
				{
					if ($db->add_user($c))  
					{	Html::success_message("Регистрация успешно завершена");
						$_SESSION['rd']=1;
					} else 
					{
						Html::error_message("Системная ошибка");
					}
				}
			}
			else Html::form_reg($c);
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
