<?php

class Helper
{
	// обновление данных сессии при обновлении корзины клиентом
	public static function refresh_cart()
	{
		//  пересчет корзины
		if (isset($_POST['r']))
		{
			$i=0;
			$_SESSION['count_cart']=0;
			$keys=array_keys($_SESSION['goods']);
			foreach ($_POST['counts'] as $count)
			{
				$count=(int)Helper::init($count);			
				if ($count>0)
				{
					$_SESSION['goods'][$keys[$i]]=$count;
					$_SESSION['count_cart']+=$count;
				}
				else if ($count==0)
				{
					unset($_SESSION['goods'][$keys[$i]]);
				}
				$i++;
			}
		}
	}
	public static function add_to_cart()
	{
		// добавление товара в корзину
			if (isset($_POST['id_goods']))
			{
				if (!isset($_SESSION['count_cart']))
				{
					$_SESSION['count_cart']=1;
					$_SESSION['goods']=array();
					$_SESSION['goods'][Helper::init($_POST['id_goods'])]=1;
				} else
				{
					$_SESSION['count_cart']++;
					if (isset($_SESSION['goods'][Helper::init($_POST['id_goods'])]))
					{
						$_SESSION['goods'][Helper::init($_POST['id_goods'])]++;
					}
					else
					{
						$_SESSION['goods'][Helper::init($_POST['id_goods'])]=1;
					}
				}
			}
	}
	
	// изменение данных сессии при выходе пользователя из кабинета
	public static function logout(&$db)
	{
		// обработка выхода из учетной записи
		if (isset($_GET['e']) && isset($_SESSION['id']) && isset($_SESSION['sk']))
		{
			if ($db->check_type_user($_SESSION['id'],$_SESSION['sk'])!=3)
			{
				$db->clear_user_sk($_SESSION['id']);
				unset($_SESSION['id']);
				unset($_SESSION['sk']);
				unset($_SESSION['count_cart']);
			}
		}
	}
	
	// обработка переменной из формы
	public static function init($var)
	{
		return stripslashes(htmlspecialchars(trim($var),ENT_QUOTES,'UTF-8'));
	}
	
	// генерация случайной строки
	public static function generateStr($length = 30){
	  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
	  $numChars = strlen($chars);
	  $string = '';
	  for ($i = 0; $i < $length; $i++) {
		$string .= substr($chars, rand(1, $numChars) - 1, 1);
	  }
	  return $string;
	}
	
	// проверка пустая ли переменная
	public static function isEmpty($data)
	{
		foreach ($data as $dt)
		{
			if ($dt==='')
				return true;
		}
		return false;
	}
	
	// перевод числа в статус пользователя
	public static function int_to_status_user($int)
	{
		if ($int==1)
			return 'админ';
		else if ($int==2)
			return 'клиент';
		else if ($int==3)
			return 'заблокирован';
		return 'неизвестно';
	}

	// перевод числа в статус заказа
	public static function int_to_status_order($int)
	{
		if ($int==1)
			return 'отменен';
		else if ($int==2)
			return 'выполнен';
		else if ($int==3)
			return 'в процессе';
		return 'неизвестно';
	}
	
	// создание заказа из одного вида в другой
	public static function createOrder($data)
	{
		$order=array();
		$order['comment']=$data[1];
		$order['email']=$data[2];
		$order['company']=$data[3];
		$order['name']=$data[4];
		$order['surname']=$data[5];
		$order['phone']=$data[6];
		$order['city']=$data[7];
		$order['address']=$data[8];
		$order['code']=$data[9];
		
		return $order;
	}
	
	// проврека пустые ли данные в массиве с данными индексами
	public static function areEmpty($data,$inds)
	{
		foreach ($inds as $ind)
		{
			if ($data[$ind]==='')
				return true;
		}
		return false;
	}
	
	// против повторной отправки формы при обновлении страницы
	public static function antirep()
	{
		if (isset($_POST['rd']))
		{
			if ($_SESSION['rd']===1)
			{ 
				unset($_SESSION['rd']);
				header("Location: index.php");  
				exit;
			} 
		} else
		{
			unset($_SESSION['rd']);
		}
	}
	
	// выделить первое предложение из текста
	public static function getFirstSentence($string)
    {
        $ind=mb_strpos($string,'.',0,"UTF-8");
        if ($ind === false)
        {
            return $string;
        }
        else
        {
            return mb_substr($string, 0,  $ind, "UTF-8");
        }
    }
	
	// содержится ли данная ссылка в адресе текущей страницы скрипта
	public static function isSelfUrl($url, $self, $var)
	{
		if (strpos($url,'t=')===false)
		{
			if (strpos($self,$url)!==false)
				return true;
			else
				return false;
		} else
		{
			$ind=strpos($url,'&');
			if ($ind===false)
				$ind=strlen($url);
			$tval=substr($url,strpos($url,'t=')+2,$ind);
			if (!empty($var) && $var==$tval)
				return true;
			else
				return false;
		}
	}
}