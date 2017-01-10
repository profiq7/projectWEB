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
<h1>Оплата и доставка</h1>                                           
<div class="clear-block">
<div id="node-387" class="node">

  <div class="content clear-block">
    
	
	<p><span style="line-height: 1.6em;">Оплатить заказ можно:</span></p>

<p><strong>1. Наличными</strong> при получении товара<br strong="" />
2. Банковской картой через систему «Расчет».<br />
3. Электронными деньгами <strong>WebMoney</strong> или <strong>EasyPay</strong> через систему «Расчет».</p>

<p>&nbsp;</p>

<p>Мы доставляем заказы следующими способами:</p>

<p><strong>1. Курьером</strong> (только для г. Минска)<br />
<strong>2. Обыкновенной посылкой по почте</strong> (при предварительной оплате через систему «Расчет»)<br />
<strong>3. Самовывозом в Минске</strong> </p>

<p>Внимание! Неоплаченные заказы хранятся 3 дня.</p>

<h3>1. Доставка курьером</h3>

<p>Осуществляется <strong>только по&nbsp;Минску в пределах МКАД</strong>. Стоимость доставки зависит от стоимости заказа:</p>

<p>При заказе:</p>

<p>до 20.00 руб стоимость доставки 8.00 руб;</p>

<p>от 20.00&nbsp;руб до 50.00&nbsp;руб&nbsp;<span style="font-size: 13px;">стоимость доставки 5.00</span><span style="font-size: 13px;">&nbsp;руб;</span><span style="font-size: 13px;">&nbsp;</span></p>

<p><strong>При заказе на сумму свыше 50.00&nbsp;руб., доставка бесплатная.</strong></p>

<p>Оплата заказа производится через систему «Расчет» либо наличными курьеру при получении товара. Срок доставки — от двух часов до двух дней после получения заказа по согласованию с покупателем.</p>

<h3>2. Доставка обыкновенной посылкой по почте.</h3>

<p>Сначала клиент оплачивает ЕРИП-счет. Дополнительно по факту получения товара на почте с вас снимается оплата почтовой службе за пересылку(вес товара, доставка, упаковка и др.), эту сумму формирует исключительно&nbsp;<span style="font-size: 13px; line-height: 20.8px;">РУП «Белпочта» в соответствии с действующими расценками.</span></p>

<p><strong>После оплаты заказа</strong> товар отправляется в ваш адрес почтой. Товар вы получаете в вашем почтовом отделении РУП «Белпочта».</p>

<p>Срок доставки от двух до пяти дней с момента оплаты заказа&nbsp;в зависимости от скорости работы РУП «Белпочта».</p>

<p>Мы всегда пойдем вам на встречу и постараемся доставить заказ в удобное для вас время. Для этого, укажите желаемое время доставки при оформлении заказа.</p>
</ul>
  </div>

  <div class="clear-block">
  
  
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

