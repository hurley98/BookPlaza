<?php
class User
{
    function __construct($conn)
    {
        $this->db = $conn;
    }


    

    // Registration
    public function register($firstname, $lastname, $email, $username, $password)
    {
        try 
        {
            // TODO Mesaj daca mail-ul sau username este deja preluat si la Login
            
            // Verificam daca mail-ul nu exista deja in baza de data, fiind mail-ul unic
            $verifyEmailStatement = $this->db->prepare("SELECT email FROM users WHERE email=:email");
            $verifyEmailStatement->bindParam(':email', $email, PDO::PARAM_STR);
            $verifyEmailStatement->execute();

            $verifyUsername = $this->db->prepare("SELECT username FROM users WHERE username=:username");
            $verifyUsername->bindParam(':username', $username, PDO::PARAM_STR);
            $verifyUsername->execute();


            if($verifyEmailStatement->rowCount() > 0)
            {
                // Daca este adevarat, mail-ul exista deja in baza de data
                echo 3;
                return false;
            }
            if($verifyUsername->rowCount() > 0)
            {
                echo 4;
                return false;
            }
            else
            {
                // Daca nu exista acel mail in BD, atunci vom continua
                $statement = $this->db->prepare("INSERT INTO users(firstname, lastname, email, username, password) VALUES(:firstname, :lastname, :email, :username, :password)");
                // Hashed password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                $statement->execute(array(
                    ':firstname' => $firstname,
                    ':lastname' => $lastname,
                    ':email' => $email,
                    ':username' => $username,
                    ':password' => $hashedPassword
                ));

                return true;
            }
        } catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    // Login
    public function login($email, $password)
    {
        if(!empty($email) && !empty($password))
        {
            try
            {
                $statement = $this->db->prepare("SELECT * FROM users WHERE email=:email");
                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                $statement->execute();

                $row = $statement->fetch(PDO::FETCH_ASSOC);

                if($statement->rowCount() > 0)
                {
                    if(password_verify($password, $row['password']))
                    {
                        $_SESSION['user'] = $row['id'];
                        return true;
                    }
                    else
                    {
                        echo 4;
                        return false;
                    }
                }
                else
                {
                    echo 5;
                    return false;
                }
            } catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }

    // Is Logged in
    public function isLoggedIn()
    {
        if(isset($_SESSION['user']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Get Username
    public function getUsername($uid)
    {
        try 
        {
            $statement = $this->db->prepare("SELECT * FROM users WHERE id=:uid");
            $statement->bindParam(':uid', $uid, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if($statement->rowCount() > 0)
            {
                return $row['username'];
            }
            else
            {
                return 'Not Logged in';
            }
        } catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    // Redirect 
    public function redirect($url)
    {
        header('Location: ' . $url);
    }

    // Admin check
    public function isAdmin($uid)
    {
        try 
        {
            $statement = $this->db->prepare("SELECT * FROM users WHERE userrole=2 AND id=:uid");
            $statement->bindParam(':uid', $uid, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if($statement->rowCount() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        } catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    //Logout
    public function logout($sess)
    {
        session_destroy();
        unset($sess);
        return true;
    }
}
?>