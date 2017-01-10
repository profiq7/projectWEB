<?php
	
class DB {
	private $conn; // переменная для подключения к базе
	
	//обновление статуса заказа
	function update_status_order($id_order,$status)
	{
		$query = "UPDATE orders SET status='".$status."' WHERE id_order=".$id_order;
		$this->conn->query($query);
	}
	
	// получение заказов по пользователю
	function get_orders_by_user($id_user)
	{
		$res=$this->conn->query("SELECT id_order FROM orders WHERE id_user=".$id_user);
        $num=$res->num_rows;
			
		$ods=array();
		for ($i=0; $i<$num; $i++)
        {
            $ods[]=$res->fetch_array(MYSQLI_ASSOC);
        }
		
		return $ods;
	}
	
	//получение данных о пользователе
	function get_one_user($id_user)
	{
		$res=$this->conn->query("SELECT * FROM users WHERE id_user=".$id_user);

        if ($res->num_rows<1)
			return '';

        return $this->decode_user($res->fetch_array(MYSQLI_ASSOC));
	}
	
	// обновление данных пользователя
	function update_user($data)
	{
		if (empty($data))
			return false;
		
		$data=$this->encode_user($data);
		if ($data['password']=='')
		{
			$query = "UPDATE users SET email='".$data['email']."', phone='".$data['phone']."' WHERE id_user=".$data['id_user'];
		} else
		{
			$query = "UPDATE users SET email='".$data['email']."', phone='".$data['phone']."', password='".md5(md5($data['password']))."' WHERE id_user=".$data['id_user'];
		}
		
		return $this->conn->query($query);
	}
	
	// получение имени пользователя
	function get_user_name($id_user)
	{
		$res=$this->conn->query("SELECT name, surname FROM users WHERE id_user=".$id_user);

        if ($res->num_rows<1)
			return '';
		$usr= $this->decode_user($res->fetch_array(MYSQLI_ASSOC));
        return $usr['name'].' '.$usr['surname'];
	}
	
	// получение всех заказов
	function get_all_orders()
	{
		$res=$this->conn->query("SELECT * FROM orders ORDER BY id_order ASC");
        $num=$res->num_rows;

		if ($num<1)
			return '';
			
        $ords=array();
        for ($i=0; $i<$num; $i++)
        {
			$ord=$res->fetch_array(MYSQLI_ASSOC);
			$res2=$this->conn->query("SELECT id_goods, count FROM orders_goods WHERE id_order=".$ord['id_order']." ORDER BY id_goods ASC");
			$num2=$res2->num_rows;
			
			if ($num2<1)
				return '';
				
			$ord['goods']=array();
			for ($j=0; $j<$num2; $j++)
			{
				$og=$res2->fetch_array(MYSQLI_ASSOC);
				$gd=$this->get_one_goods($og['id_goods']);
				$gd['count']=$og['count'];
				$ord['goods'][]=$gd;
			}
			
			$ord['name']=$this->get_user_name($ord['id_user']);

			$ords[]=$ord;
        }
		
        return $ords;
	}
	
	// получение заказов конкретного пользователя
	function get_orders($id_user)
	{
		$res=$this->conn->query("SELECT * FROM orders WHERE id_user=".$id_user." ORDER BY id_order ASC");
        $num=$res->num_rows;

		if ($num<1)
			return '';
			
        $ords=array();
        for ($i=0; $i<$num; $i++)
        {
			$ord=$res->fetch_array(MYSQLI_ASSOC);
			$res2=$this->conn->query("SELECT id_goods, count FROM orders_goods WHERE id_order=".$ord['id_order']." ORDER BY id_goods ASC");
			$num2=$res2->num_rows;
			
			if ($num2<1)
				return '';
				
			$ord['goods']=array();
			for ($j=0; $j<$num2; $j++)
			{
				$og=$res2->fetch_array(MYSQLI_ASSOC);
				$gd=$this->get_one_goods($og['id_goods']);
				$gd['count']=$og['count'];
				$ord['goods'][]=$gd;
			}

			$ords[]=$ord;
        }
		
        return $ords;
	}
	
	// получение конкретного заказа
	function get_one_order($id_order)
	{
		$res=$this->conn->query("SELECT * FROM orders WHERE id_order=".$id_order);			
        $ord=$res->fetch_array(MYSQLI_ASSOC);
		
		$ord['user']=$this->get_one_user($ord['id_user']);
		
		$res=$this->conn->query("SELECT id_goods, count FROM orders_goods WHERE id_order=".$ord['id_order']." ORDER BY id_goods ASC");
		$num=$res->num_rows;
	
		$ord['goods']=array();
		for ($j=0; $j<$num; $j++)
		{
			$og=$res->fetch_array(MYSQLI_ASSOC);
			$gd=$this->get_one_goods($og['id_goods']);
			$gd['count']=$og['count'];
			$ord['goods'][]=$gd;
		}
		
        return $ord;
	}
	
	// добавление заказа
	function add_order($data, $goods, $id_user)
	{
		$total_price=0;
		foreach ($goods as $key=>$count)
		{
			$gd=$this->get_one_goods($key);
			$total_price+=$gd['price']*$count;
		}
		
		$query = "INSERT INTO orders (date, id_user, company, status, fio, city, address, code, email, comment, phone, price) 
                 VALUES ('".date("d.m.Y")."','".$id_user."','".$data['company']."', '3','".$data['name'].' '.$data['surname']."','".$data['city']."', '".$data['address']."','".$data['code']."','".$data['email']."','".$data['comment']."', '".$data['phone']."', ".$total_price.")";
        if (!$this->conn->query($query))
			return false;
		
		$id=$this->conn->insert_id;
		foreach ($goods as $key=>$count)
		{
			$query = "INSERT INTO orders_goods (id_goods, id_order, count)
					VALUES (".$key.", ".$id.",".$count.")";
			if (!$this->conn->query($query))
				return false;
		}
		return true;
	}
	
	// получение количества товаров
	function get_count_goods_strict($id_category, $bonus)
	{
		if ($bonus!=0)
			$res=$this->conn->query("SELECT COUNT(*) FROM goods WHERE id_category=".$id_category." AND bonus=".$bonus);
		else
			$res=$this->conn->query("SELECT COUNT(*) FROM goods WHERE id_category=".$id_category);
		$count=$res->fetch_array(MYSQLI_ASSOC);
		return $count['COUNT(*)'];
	}
	
	// получение товаров по ключевому слово в заголовке и описании товара
	function get_search_goods($words, $id_category)
	{
		$gds=array();
		if ($id_category==0)
		{
			$query="SELECT * FROM goods WHERE (locate('".$words."',title)>0) OR (locate('".$words."',description)>0)";
		}
		else
		{
			$query="SELECT * FROM goods WHERE id_category=".$id_category." AND ((locate('".$words."',title)>0) OR (locate('".$words."',description)>0))";
		}
		
		$res=$this->conn->query($query);
		$num=$res->num_rows;
		for ($i=0; $i<$num; $i++)
        {
            $gds[]=$res->fetch_array(MYSQLI_ASSOC);
        }
		
		return $gds;
	}
	
	// получение товаров для каталога
	function get_goods($id_category, $bonus, $page, $sort)
	{
		if ($bonus!=0)
			$res=$this->conn->query("SELECT * FROM goods WHERE id_category=".$id_category." AND visible=1 AND bonus=".$bonus);
		else
			$res=$this->conn->query("SELECT * FROM goods WHERE visible=1 AND id_category=".$id_category);
        $num=$res->num_rows;

        $gds=array();
        for ($i=0; $i<$num; $i++)
        {
            $gds[]=$res->fetch_array(MYSQLI_ASSOC);
        }
		
		if ($this->has_sub_categories($id_category))
		{
			$scats=$this->get_sub_categories($id_category);
			foreach ($scats as $scat)
			{
				if ($bonus!=0)
					$res=$this->conn->query("SELECT * FROM goods WHERE id_category=".$scat['id_category']." AND visible=1 AND bonus=".$bonus);
				else
					$res=$this->conn->query("SELECT * FROM goods WHERE visible=1 AND id_category=".$scat['id_category']);
				$num=$res->num_rows;
				for ($i=0; $i<$num; $i++)
				{
					$gds[]=$res->fetch_array(MYSQLI_ASSOC);
				}				
			}
		}

		if ($sort==0) // id
		{
			usort($gds, "compare_goods0");
		} else if ($sort==1) // title
		{
			usort($gds, "compare_goods1");
		} else if ($sort==2) // price
		{
			usort($gds, "compare_goods2");
		}
		
        return array_slice($gds, 9*$page, 9);
	}
	
	// получение количества товаров
	function get_count_goods($id_category, $bonus)
	{
		if ($bonus!=0)
			$res=$this->conn->query("SELECT COUNT(*) FROM goods WHERE id_category=".$id_category." AND visible=1 AND bonus=".$bonus);
		else
			$res=$this->conn->query("SELECT COUNT(*) FROM goods WHERE visible=1 AND id_category=".$id_category);
		$count=$res->fetch_array(MYSQLI_ASSOC);
		if ($this->has_sub_categories($id_category))
		{
			$scats=$this->get_sub_categories($id_category);
			foreach ($scats as $scat)
			{
				if ($bonus!=0)
					$res=$this->conn->query("SELECT COUNT(*) FROM goods WHERE id_category=".$scat['id_category']." AND visible=1 AND bonus=".$bonus);
				else
					$res=$this->conn->query("SELECT COUNT(*) FROM goods WHERE visible=1 AND id_category=".$scat['id_category']);
				$tcount=$res->fetch_array(MYSQLI_ASSOC);
				$count['COUNT(*)']+=$tcount['COUNT(*)'];	
			}
		}
		return $count['COUNT(*)'];
	}
	
	// получение данных конкретной категории
	function get_category($id_category)
	{
		$res=$this->conn->query("SELECT * FROM categories WHERE id_category=".$id_category);
        $num=$res->num_rows;

        if ($num<1)
			return '';

        return $res->fetch_array(MYSQLI_ASSOC);
	}
	
	// проверка есть ли подкатегории у данной категории
	function has_sub_categories($id_parent)
	{
		$res=$this->conn->query("SELECT id_category FROM categories WHERE id_parent=".$id_parent);
        $num=$res->num_rows;

        if ($num<1)
			return false;
		return true;
	}
	
	// получение родительской категории
	function get_parent_cat($id_category)
	{
		$res=$this->conn->query("SELECT id_parent FROM categories WHERE id_category=".$id_category);
        $num=$res->num_rows;

        if ($num<1)
			return false;

        $cat=$res->fetch_array(MYSQLI_ASSOC);

		return $cat['id_parent'];
	}
	
	// проверка является ли категория родительской
	function is_main_cat($id_category)
	{
		$res=$this->conn->query("SELECT id_parent FROM categories WHERE id_category=".$id_category);
        $num=$res->num_rows;

        if ($num<1)
			return false;

        $cat=$res->fetch_array(MYSQLI_ASSOC);

        if ($cat['id_parent']==0)
			return true;
		return false;
	}
	
	// получение данных о конкретном товаре
	function get_one_goods($id_goods)
	{
		$res=$this->conn->query("SELECT * FROM goods WHERE id_goods=".$id_goods);
        $num=$res->num_rows;

        if ($num<1)
			return '';

        return $res->fetch_array(MYSQLI_ASSOC);
	}
	
	// получение id категории данного товара
	function get_id_category_goods($id_goods)
	{
		$res=$this->conn->query("SELECT id_category FROM goods WHERE id_goods=".$id_goods);
        $num=$res->num_rows;

        if ($num<1)
			return 0;

        $cat=$res->fetch_array(MYSQLI_ASSOC);

        return $cat['id_category'];
	}
	
	// подсчет рейтинга данного товара (количество участий в заказах)
	function get_rating_goods($id_goods)
	{
		$res=$this->conn->query("SELECT SUM(count) FROM orders_goods WHERE id_goods=".$id_goods);
        $num=$res->num_rows;

        $rt=$res->fetch_array(MYSQLI_ASSOC);
		
		if ($rt['SUM(count)']>5)
			$rt['SUM(count)']=5;

        return $rt['SUM(count)'];
	}
	
	// получение случайных товаров
	function get_rand_goods($count, $bonus)
	{
		$res=$this->conn->query("SELECT * FROM goods WHERE bonus=".$bonus." AND visible=1 ORDER BY rand() LIMIT ".$count);
        $num=$res->num_rows;

        $gds=array();
        for ($i=0; $i<$num; $i++)
        {
            $gds[]=$res->fetch_array(MYSQLI_ASSOC);
        }

        return $gds;
	}
	
	// удаление sk при выходе из кабинета
	function clear_user_sk($id)
	{
		if (empty($id))
			return false;
		
		$query = "UPDATE users SET sk=' ' WHERE id_user=".$id;
		
		return $this->conn->query($query);
	}
	
	// получение данных о пользователе по его номеру и sk
	function get_user_info($id, $sk)
	{
		if (empty($id) || empty($sk))
			return '';
			
		$res=$this->conn->query("SELECT * FROM users WHERE id_user='".$id."' AND sk='".$sk."'");
        $num=$res->num_rows;

        if ($num<1)
			return '';

        return $this->decode_user($res->fetch_array(MYSQLI_ASSOC));
	}
	
	// получение типа пользователя по его номер и sk
	function check_type_user($id, $sk)
	{
		if (empty($id) || empty($sk))
			return 3;
			
		$res=$this->conn->query("SELECT type FROM users WHERE id_user='".$id."' AND sk='".$sk."'");
        $num=$res->num_rows;

        if ($num<1)
			return 3;
		
		$user=$res->fetch_array(MYSQLI_ASSOC);
        return $user['type'];
	}
	
	// добавление sk конкретному пользователю
	function set_sk($id_user,$sk)
	{
		if (empty($sk))
			return false;
			
		$query = "UPDATE users SET sk='".$sk."' WHERE id_user=".$id_user;
		
		return $this->conn->query($query);
	}
	
	// получение данных о пользователе по почте и паролю
	function get_user($data)
	{
		$res=$this->conn->query("SELECT * FROM users WHERE email='".base64_encode($data[1])."' AND password='".md5(md5($data[2]))."' AND type<>3");
        $num=$res->num_rows;

        if ($num<1)
			return '';

		
        return $this->decode_user($res->fetch_array(MYSQLI_ASSOC));
	}
	
	// добавление нового пользователя
	function add_user($data)
	{
		$data[1]=base64_encode($data[1]);
		$data[2]=base64_encode($data[2]);
		$data[8]=base64_encode($data[8]);
		$query = "INSERT INTO users (birth, email, name, surname, password, phone, type, sk) 
                 VALUES ('".$data[5].'.'.$data[6].'.'.$data[7]."', '".$data[1]."','".$data[3].' '.$data[4]."','".$data[2]."','".md5(md5($data[9]))."','".$data[8]."', 2, '0')";
        return $this->conn->query($query);
	}
	
	// добавление товара
	function add_goods($data)
	{
		$query = "INSERT INTO goods (id_category, price, image, title, description, bonus) 
                 VALUES ('".$data[2]."', '".$data[3]."','".$data[4]."','".$data[1]."','".$data[5]."','".$data[6]."')";
        return $this->conn->query($query);
	}
	
	// обновление данных конкретного товара
	function update_edit_goods($data)
	{
		$query = "UPDATE goods SET id_category=".$data[2].", price=".$data[3].", image='".$data[4]."', title='".$data[1]."', description='".$data[5]."', bonus='".$data[6]."', visible=".$data[7]." WHERE id_goods=".$data[0]; 

        return $this->conn->query($query);
	}
	
	// добавление статьи
	function add_article($title, $text, $date, $category)
	{
		$query = "INSERT INTO articles (title, text, date, category) 
                 VALUES ('".$title."', '".$text."','".$date."','".$category."')";
        return $this->conn->query($query);
	}
	
	// изменение категории
	function change_category($id_category, $category)
	{
		if (empty($category))
			return false;
		
		$query = "UPDATE categories SET category='".$category."' WHERE id_category=".$id_category;
		
		return $this->conn->query($query);
	}
	
	// добавление подкатегории
	function add_sub_category($id_parent, $category)
    {
		if (empty($category))
			return false;
		
        $query = "INSERT INTO categories (category, id_parent) 
                 VALUES ('".$category."', '".$id_parent."')";
        return $this->conn->query($query);
    }
	
	// добавление главной категории
	function add_main_category($category)
    {
		if (empty($category))
			return false;
		
        $query = "INSERT INTO categories (category, id_parent) 
                 VALUES ('".$category."', '0')";
        return $this->conn->query($query);
    }
	
	// получение статьи
	function get_article($id)
	{
		$res=$this->conn->query("SELECT * FROM articles WHERE id_article=".$id);
        $num=$res->num_rows;

        if ($num<1)
			return '';

        return $res->fetch_array(MYSQLI_ASSOC);
	}
	
	// получение нескольких статей данного типа
	function get_articles($count = 10, $category = 1)
	{
		$res=$this->conn->query("SELECT * FROM articles WHERE category=".$category." ORDER BY id_article DESC LIMIT 0, ".$count);
        $num=$res->num_rows;

        $arts=array();
        for ($i=0; $i<$num; $i++)
        {
            $arts[]=$res->fetch_array(MYSQLI_ASSOC);
        }

        return $arts;
	}
	
	// проверка существования email
	function exists_email($email)
	{
		$email=base64_encode($email);
		$res=$this->conn->query("SELECT id_user FROM users WHERE email='".$email."'");
        $num=$res->num_rows;
		if ($num>0)
			return true;
		return false;
	}
	
	// кодирование данных пользователя
	function encode_user($data)
	{
		$data['email']=base64_encode($data['email']);
		$data['surname']=base64_encode($data['surname']);
		$data['phone']=base64_encode($data['phone']);
		
		return $data;
	}
	
	// декодирование данных пользователя
	function decode_user($data)
	{
		$data['email']=base64_decode($data['email']);
		$data['surname']=base64_decode($data['surname']);
		$data['phone']=base64_decode($data['phone']);
		
		return $data;
	}
	
	// получение данных пользователей
	function get_users()
	{
		$res=$this->conn->query("SELECT * FROM users ORDER BY id_user ASC");
        $num=$res->num_rows;

        $users=array();
        for ($i=0; $i<$num; $i++)
        {
            $users[]=$this->decode_user($res->fetch_array(MYSQLI_ASSOC));
        }

        return $users;
	}
	
	// получение категорий
	function get_main_categories()
	{
		$res=$this->conn->query("SELECT * FROM categories WHERE id_parent=0 ORDER BY category ASC");
        $num=$res->num_rows;

        $cats=array();
        for ($i=0; $i<$num; $i++)
        {
            $cats[]=$res->fetch_array(MYSQLI_ASSOC);
        }

        return $cats;
	}
	
	// получение категорий и подкатегорий
	function get_categories()
    {
        $res=$this->conn->query("SELECT * FROM categories WHERE id_parent=0 ORDER BY category ASC");
        $num=$res->num_rows;

        $cats=array();
        for ($i=0; $i<$num; $i++)
        {
            $cats[]=$res->fetch_array(MYSQLI_ASSOC);
        }
		
		for ($i=0; $i<$num; $i++)
		{
			$cats[$i]['childs']=$this->get_sub_categories($cats[$i]['id_category']);
		}

        return $cats;
    }
	// получение подкатегорий
	function get_sub_categories($id)
    {
        $res=$this->conn->query("SELECT * FROM categories WHERE id_parent=".$id." ORDER BY category ASC");
        $num=$res->num_rows;

        $cats=array();
        for ($i=0; $i<$num; $i++)
        {
            $cats[]=$res->fetch_array(MYSQLI_ASSOC);
        }

        return $cats;
    }
	
	// подключение к базе
    function __construct() {
       $this->conn = new mysqli('localhost', 'root', '', 'zshop'); 
       mysqli_set_charset($this->conn,"utf8");
    }
    // отключение от базы
    function __destruct() {
        $this->conn->close();
    }
}
// функции для сортировки товаров (по названию, по id, по цене)
function compare_goods0($gd1, $gd2)
{
		if ($gd1['id_goods']==$gd2['id_goods'])
			return 0;
		return ($gd1['id_goods']<$gd2['id_goods'])? 1 : -1;
}

function compare_goods1($gd1, $gd2)
{
		if ($gd1['title']==$gd2['title'])
			return 0;
		return ($gd1['title']<$gd2['title'])? -1 : 1;
}

function compare_goods2($gd1, $gd2)
{
		if ($gd1['price']==$gd2['price'])
			return 0;
		return ($gd1['price']<$gd2['price'])? 1 : -1;
}