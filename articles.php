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
								
<h1><?php echo Html::article_type($_GET['t']);?></h1> 
                                   
<div class="clear-block">
<div class="view view-news view-id-news view-display-id-page_1 view-dom-id-dc6a61950558ca04d004ebbace54a0c5">
<div class="view-content">

<?php 
if (isset($_GET['t']) && !isset($_GET['id']))
{
	$arts=$db->get_articles(10, Html::article_int_type(Helper::init($_GET['t'])));
	foreach ($arts as $art)
	{
		$art['text']=Helper::getFirstSentence($art['text']);
		Html::article($art);
	}
} else if (isset($_GET['id']))
{
	Html::article($db->get_article(Helper::init($_GET['id'])));
}
?>
</div>
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
