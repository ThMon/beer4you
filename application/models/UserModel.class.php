 <?php


class UserModel {

     public function signUp(
        $firstName,
        $lastName,
        $email,
        $password,
        $address,
        $city,
        $zipCode)
    {
        $database = new Database();

        // On vérifie qu'il y a un utilisateur avec l'adresse e-mail spécifiée.
        $user = $database->queryOne
        (
            "SELECT Id FROM User WHERE Email = ?", [ $email ]
        );

        // Est-ce qu'on a bien trouvé un utilisateur ?
        if(empty($user) == false)
        {
            var_dump('pas bon la mail est déjà là');
        }

        $sql = 'INSERT INTO users
        (
            firstName,
            lastName,
            email,
            password,
            creationTimeStamp,
            address,
            city,
            zip,
            role
        ) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, "user")';


        $passwordHash = $this->hashPassword($password);


        $database->executeSql($sql,
        [
            $firstName,
            $lastName,
            $email,
            $passwordHash,
            $address,
            $city,
            $zipCode
        ]);

        // Ajout d'un message de notification qui s'affichera sur la page d'accueil.
      
    }



    

    private function verifyPassword($password, $hashedPassword)
    {
        return crypt($password, $hashedPassword) == $hashedPassword;
    }

    private function hashPassword($password)
    {
       
        $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);
        

        return crypt($password, $salt); 
    }

    public function findWithEmailPassword($email, $password)
    {
        $database = new Database();

        // Récupération de l'utilisateur ayant l'email spécifié en argument.
        $user = $database->queryOne
        (
            "SELECT
                *
            FROM users
            WHERE email = ?",
            [ $email ]
        );

        var_dump($user);

        // Est-ce qu'on a bien trouvé un utilisateur ?
        if(empty($user) == true)
        {
            var_dump('non !');
        }

        // Est-ce que le mot de passe spécifié est correct par rapport à celui stocké ?
        if($this->verifyPassword($password, $user['password']) == false)
        {
            
                var_dump('Le mot de passe spécifié est incorrect');
        } else {
            $_SESSION['user']['id'] = $user['Id'];
            $_SESSION['user']['firstname'] = $user['firstName'];
            $_SESSION['user']['lastname'] = $user['lastName'];
            $_SESSION['user']['email'] = $user['email'];
            $_SESSION['user']['role'] = $user['role'];
        }

        var_dump($_SESSION);
        
    }

    public function listAllUsers()
    {
        $database = new Database();

        $sql = 'SELECT
                    *
                FROM users';

        return $database->query($sql, []);
    }

    public function changeUserRole($id, $role)
    {
        $database = new Database();

        $sql = 'UPDATE users SET role=? WHERE Id=?';

        $database->executeSql($sql, [$role, $id]);

    }

    public function deleteUser($id)
    {
        $database = new Database();

        $sql = 'DELETE FROM users WHERE Id=?';

        $database->executeSql($sql, [ $id ]);
    }

    public function findOneUser($id)
    {
        $database = new Database();

        $sql = 'SELECT * FROM users WHERE Id=?';

        return $database->queryOne($sql, [ $id ]);

    }

    public function changeUserProfil($post, $id)
    {
        $database = new Database();

        $sql = 'UPDATE users SET firstName=?, lastName=?, email=?, address=?, city=?, zip=? WHERE Id=?';

        $database->executeSql($sql, [ $post['firstname'], $post['lastname'], $post['email'], $post['address'], $post['city'], $post['zip'], $id]);

    }
    
}
