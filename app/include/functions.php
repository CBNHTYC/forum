<?php
    function getCategories ()
    {
        global $link;
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($link, $sql); #запрос на сервер
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC); #преобразование инфы в массив, второй параметр указывает на то, что массив будет ассоциативным, индексы будут соответтвовать названию полей в бд
        
        return $categories;
    }
    
    function getPosts()
    {
        global $link;
        
        $sql = "SELECT * FROM posts";
        $result = mysqli_query($link, $sql);
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $posts;
    }
    
    function getSubcatByID($subcatID)
    {
        global $link;
        
        $sql = "SELECT * FROM subcategories WHERE id = ".$subcatID;
        
        $result = mysqli_query($link, $sql);
        
        $subcat = mysqli_fetch_assoc($result);
        
        return $subcat;
    }
    
    function generateCode($length = 16)#задаем длину строки
    {
        $string = '';
        $chars = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890'; #символы, которые мы будем использовать ддя генерации случайной строки кода
        $numChars = strlen($chars);
        
        for ($i = 0; $i < $length; $i++)
        {
            $string .= substr($chars, rand(1, $numChars) - 1, 1); # .= - это конкатенирование, subsr извлекает рандомный символ из строки chars
        }
        return $string;
    }
    function insertSubscribe($email)
    {
        global $link;
        $localEmail = mysqli_real_escape_string($link, $email);#делает строку безопасной, предотвращая sql инъекции
        
        #1.Проверить, есть ли подписчик в базе
        $query = "SELECT * FROM subscribers WHERE EMAIL = '$localEmail'";
        
        $result = mysqli_query($link, $query);
                
        
        if (!$result)
        {
            #2.Если его нет, то создаём подписчика с уникальным кодом (неактивного)
            $subscriberCode = generateCode();
            $insertQuery = "INSERT INTO subscribers (email, code) VALUES ('$email', '$subscriberCode')";
            
            $result = mysqli_query($link, $insertQuery);
                    
            if (!mysqli_num_rows($result))
            {
                return 'created';
            }
            else
            {
                return 'fail';
            }
        }
        else
        {
            #3.Если он есть, направим на главную страницу, отправиви сообщение о его существовании в родительскую функцию
            return 'exist';
        }       
    }
    
    
    function getCategoryTitle($categoryID)
    {
        global $link;

        $localCategoryID = mysqli_real_escape_string($link, $categoryID); #очищение строки от хацкерских запросов?
        $sql = 'SELECT * FROM categories WHERE id = "'.$localCategoryID.'"';
        $result = mysqli_query($link, $sql);
        $category = mysqli_fetch_assoc($result);

        return $category['title'];

    }
    
    function getSubcatByCategory($categoryID)
    {
        global $link;
        
        $localCategoryID = mysqli_real_escape_string($link, $categoryID); #очищение строки от хацкерских запросов?
        $sql = 'SELECT * FROM subcategories WHERE catID = "'.$localCategoryID.'"';
        $result = mysqli_query($link, $sql);
        $subcat = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $subcat;
    }
    
    function addSubcat($categoryID, $title, $description, $userID)
    {
        global $link;
        $localCatID = mysqli_real_escape_string($link, $categoryID);#делает строку безопасной, предотвращая sql инъекции
        $localTitle = mysqli_real_escape_string($link, $title);
        $localDescription = mysqli_real_escape_string($link, $description);
        $localUserID = mysqli_real_escape_string($link, $userID);
        #1.Проверить, есть ли подтема в базе
        $query = 'SELECT * FROM subcategories WHERE title = "'.$localTitle.'"';
        $result = mysqli_query($link, $query);
        if (!$result->num_rows)
        {
            #2.Если его нет, то создаём подтему
            $insertQuery = "INSERT INTO subcategories (catID, title, description, userID) VALUES ('$localCatID', '$localTitle', '$localDescription', '$localUserID')";
            
            $result = mysqli_query($link, $insertQuery);
           
                    
            if ($result)
            {
                return 'created';
            }
            else
            {
                return 'fail';
            }
        }
        else
        {
            #3.Если он есть, направим на главную страницу, отправиви сообщение о его существовании в родительскую функцию
            return 'exist';
        }
    }
    
    function getPostsBySubcat($subcatID)
    {
        global $link;
        
        $localSubcatID = mysqli_real_escape_string($link, $subcatID); #очищение строки от хацкерских запросов?
        $sql = 'SELECT * FROM posts WHERE subcatID = "'.$localSubcatID.'"';
        $result = mysqli_query($link, $sql);
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $posts;
    }
    
    function getSubcatTitle($subcatID)
    {
        global $link;

        $localSubcatID = mysqli_real_escape_string($link, $subcatID); #очищение строки от хацкерских запросов?
        $sql = 'SELECT * FROM categories WHERE id = "'.$localSubcatID.'"';
        $result = mysqli_query($link, $sql);
        $subcat = mysqli_fetch_assoc($result);

        return $subcat['title'];

    }
    
    function getUserNameByID($userID)
    {
        global $link;
        
        $localUserID= mysqli_real_escape_string($link, $userID);
        if (!$localUserID == 0)
        {
            $sql = "SELECT * FROM users WHERE id = ".$localUserID;

            $result = mysqli_query($link, $sql);

            $user = mysqli_fetch_assoc($result);
            $name = $user['username'];
        }
        else 
        {
            $name = 'Гость';
        }
        return $name;
    }
    
    function editSubcat($subcatID, $title, $description, $userID)
    {
        global $link;
        $localSubcatID = mysqli_real_escape_string($link, $subcatID);#делает строку безопасной, предотвращая sql инъекции
        $localTitle = mysqli_real_escape_string($link, $title);
        $localDescription = mysqli_real_escape_string($link, $description);
        $localUserID = mysqli_real_escape_string($link, $userID);
        #1.Проверить, есть ли подтема в базе
        $query = 'SELECT * FROM subcategories WHERE id = "'.$localSubcatID.'"';
        $result = mysqli_query($link, $query);
        
        $result = mysqli_query($link, $query);
        if ($result->num_rows)
        {
            $sql = 'UPDATE `subcategories` SET `title` = "'.$localTitle.'", `description` = "'.$localDescription.'" WHERE `subcategories`.`id` = "'.$localSubcatID.'"';
            $result = mysqli_query($link, $sql);
                   
            if ($result)
            {
                return 'edited';
            }
            else
            {
                return 'fail';
            }
        }
        else
        {
            #3.Если он есть, направим на главную страницу, отправиви сообщение о его существовании в родительскую функцию
            return 'notExist';
        }
        
        
    }
    
    function addPost($subcatID, $text, $userID)
    {
        global $link;
        $localSubcatID = mysqli_real_escape_string($link, $subcatID);#делает строку безопасной, предотвращая sql инъекции
        $localText = mysqli_real_escape_string($link, $text);
        $localUserID = mysqli_real_escape_string($link, $userID);
        $date = date('d-m-Y H:i:s', time());
        $insertQuery = "INSERT INTO posts (subcatID, text, userID, date) VALUES ('$localSubcatID', '$localText', '$localUserID', '$date')";

        $result = mysqli_query($link, $insertQuery);


        if ($result)
        {
            return 'created';
        }
        else
        {
            return 'fail';
        }
    }
    
    function editPost($postID, $subcatID, $text, $userID)
    {
        global $link;
        $localPostID = mysqli_real_escape_string($link, $postID);
        $localSubcatID = mysqli_real_escape_string($link, $subcatID);#делает строку безопасной, предотвращая sql инъекции
        $localText = mysqli_real_escape_string($link, $text);
        $localUserID = mysqli_real_escape_string($link, $userID);
        #1.Проверить, есть ли подтема в базе
        $query = 'SELECT * FROM posts WHERE id = "'.$localPostID.'"';
        $result = mysqli_query($link, $query);

        if ($result->num_rows)
        {
            $sql = 'UPDATE `posts` SET `text` = "'.$localText.'" WHERE `id` = "'.$localPostID.'"';
            $result = mysqli_query($link, $sql);
                   
            if ($result)
            {
                return 'edited';
            }
            else
            {
                return 'fail';
            }
        }
        else
        {
            #3.Если он есть, направим на главную страницу, отправиви сообщение о его существовании в родительскую функцию
            return 'notExist';
        }
        
        
    }
    
    function addUser($username, $email, $password)
    {
        global $link;
        $localEmail = mysqli_real_escape_string($link, $email);#делает строку безопасной, предотвращая sql инъекции
        $localUsername = mysqli_real_escape_string($link, $username);
        $localPassword = mysqli_real_escape_string($link, $password);
        #1.Проверить, есть ли подписчик в базе
        $query = "SELECT * FROM users WHERE email = '$localEmail'";
        
        $result = mysqli_query($link, $query);
        
        if (!$result->num_rows && $localUsername!='Гость')
        {
            #2.Если его нет, то создаём подписчика с уникальным кодом
            $userCode = generateCode();
            $insertQuery = "INSERT INTO users (email, code, username, password) VALUES ('$localEmail', '$userCode', '$localUsername', '$localPassword')";
            
            $result = mysqli_query($link, $insertQuery);
                    
            if ($result)
            {
                return 'created';
            }
            else
            {
                if ($localUsername == 'Гость')
                {
                    return 'Invalidusername';
                }
                else 
                {
                    return 'fail';
                }
            }
        }
        else
        {
            #3.Если он есть, направим на главную страницу, отправиви сообщение о его существовании в родительскую функцию
            return 'exist';
        }       
    }
    
    function loginUser ($password, $email)
    {
        global $link;
        $localEmail = mysqli_real_escape_string($link, $email);#делает строку безопасной, предотвращая sql инъекции
        $localPassword = mysqli_real_escape_string($link, $password);
        #1.Проверить, есть ли подписчик в базе
        $query = "SELECT * FROM users WHERE email = '$localEmail'";
        $result = mysqli_query($link, $query);
        $output = array(
            "userID" => 0,
            'result' => 'notExist',
            'isAdmin' => 0,
        );
        if ($result->num_rows)
        {
            $user = mysqli_fetch_assoc($result); 
            if ($user['password'] == $localPassword)
            {
                $output['userID'] = $user['id'];
                $output['result'] = 'entered';
                $output['isAdmin'] = $user['status'];
            }
            else
            {
                $p = $user["password"];
                echo var_dump($user);
                echo var_dump($output);
                $output['result'] = 'fail';
            }
        }
        return $output;
    }
    
    function getUserImgByID($userID)
    {
        global $link;
        
        $localUserID= mysqli_real_escape_string($link, $userID);
        if (!$localUserID == 0)
        {
            $sql = "SELECT * FROM users WHERE id = ".$localUserID;

            $result = mysqli_query($link, $sql);

            $user = mysqli_fetch_assoc($result);
            $name = $user['img'];
        }
        else 
        {
            $name = 'default.jpg';
        }
        return $name;
    }
    
    function getUserByID($userID)
    {
        global $link;
        
        $localUserID= mysqli_real_escape_string($link, $userID);
        if (!$localUserID == 0)
        {
            $sql = "SELECT * FROM users WHERE id = ".$localUserID;

            $result = mysqli_query($link, $sql);

            $user = mysqli_fetch_assoc($result);
        }
        else 
        {
            $user['id'] = 0;
        }
        return $user;
    }
