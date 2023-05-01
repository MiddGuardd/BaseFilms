<?php

/**
 * Summary of CategorieManager
 */
class CategorieManager extends BDD{

	public function add(string $username, string $mail, string $password){
		$sql = 'INSERT INTO vc_utilisateurs (username, mail, password) VALUES (:u, :m, :p)';
		
		$insert = $this->co->prepare($sql);
		$insert->execute([
            'u' => $username,
			'm' => $mail,
			'p' => $password
		]);

		return $insert->rowCount(); // Retourne le nombre de lignes affectées par la requete
	}

    public function is_user_taken(string $username){
        $sql = 'SELECT * FROM vc_utilisateurs WHERE username = :u';

		$select = $this->co->prepare($sql);
		$select->execute([
            'u'=>$username
        ]);

        $var = $select->fetch();

        if(!empty($var)) return $var['id'];
        else return false;
    }

    public function is_mail_taken(string $mail){
        $sql = 'SELECT * FROM vc_utilisateurs WHERE mail = :m';

		$select = $this->co->prepare($sql);
		$select->execute([
            'm'=>$mail
        ]);

        $var = $select->fetch();

        if(!empty($var)) return true;
        else return false;
    }

    public function is_pass_correct(string $username, string $verify){
        $sql = 'SELECT * FROM vc_utilisateurs WHERE username =:u';

        $select = $this->co->prepare($sql);
        $select->execute([
            'u' => $username
        ]);

        $var = $select->fetch();
        if(password_verify($verify, $var['password'])) return true;
        else return false;
    }

    public function edit_username(string $username, int $id){
        $sql = 'UPDATE vc_utilisateurs SET username = :u WHERE id=:id';
        $update = $this->co->prepare($sql);
        $update->execute([
            'u' => $username,
            'id' => $id
        ]);

        return $update->rowCount();
    }

    public function edit_pass(string $password, int $id){
        $sql = 'UPDATE vc_utilisateurs SET password = :p WHERE id=:id';
        $update = $this->co->prepare($sql);
        $update->execute([
            'p' => $password,
            'id' => $id
        ]);

        return $update->rowCount();
    }

    public function delete_usr(int $id){
        $sql = 'DELETE FROM vc_utilisateurs WHERE id=:id';
        $delete = $this->co->prepare($sql);
        $delete->execute([
            'id' => $id
        ]);

        $var = $delete->rowCount();
        return $var;
    }

    public function get_id(string $username){
        $sql = "SELECT * FROM vc_utilisateurs WHERE username = :u";
        $select = $this->co->prepare($sql);
        $select->execute([
            'u'=>$username
        ]);

        $var = $select->fetch();
        return $var['id'];
    }

    public function users(){
        $sql = "SELECT * FROM vc_utilisateurs ORDER BY 'id' DESC";
        $select = $this->co->prepare($sql);
        $select->execute();
        $var = $select->fetchAll();

        return $var;
    }

    public function get_user_infos(int $id){
        $sql = "SELECT * FROM vc_utilisateurs WHERE id= :id";
        $select = $this->co->prepare($sql);
        $select->execute([
            'id'=>$id
        ]);
        $var = $select->fetch();
        return $var;
    }
    
    public function add_film(String $titre, String $miniature, String $synopsis, int $note){

        $sql = 'INSERT INTO vc_films (titre, image, synopsis, note, user_id) VALUES (:t, :m, :s, :n, :id)';
		
		$insert = $this->co->prepare($sql);
		$insert->execute([
            't' => $titre,
			'm' => $miniature,
			's' => $synopsis,
            'n' => $note,
            'id' => $_SESSION['id']
		]);

		return $insert->rowCount();
    }

    public function delete_film(int $id){
        $sql = "DELETE FROM vc_films WHERE id=:id";
        $delete = $this->co->prepare($sql);
        $delete->execute([
            'id' => $id
        ]);

        $var = $delete->rowCount();
        return $var;
    }

    public function delete_all_films(int $user_id){
        $sql = 'DELETE FROM vc_films WHERE user_id=:user_id';
        $delete = $this->co->prepare($sql);
        $delete->execute([
            'user_id' => $user_id
        ]);

        $var = $delete->rowCount();
        return $var;
    }

    public function get_infos(int $id){
        $sql = "SELECT * FROM vc_films WHERE id =:id";
        $select = $this->co->prepare($sql);
        $select->execute([
            'id' => $id
        ]);
        $var = $select->fetch();

        return $var;
    }

    public function last_films(int $limit, int $user_id){
        $sql = "SELECT * FROM vc_films WHERE user_id =:user_id ORDER BY 'id' DESC LIMIT $limit";
        $select = $this->co->prepare($sql);
        $select->execute([
            'user_id' => $user_id
        ]);
        $var = $select->fetchAll();

        return $var;
    }

    public function films(int $limit){
        $sql = "SELECT * FROM vc_films ORDER BY 'id' DESC LIMIT $limit";
        $select = $this->co->prepare($sql);
        $select->execute();
        $var = $select->fetchAll();

        return $var;
    }

    public function add_fav(int $fav, int $id){

        $sql = 'UPDATE vc_films SET fav = :f WHERE id=:id';
		
		$update = $this->co->prepare($sql);
		$update->execute([
            'f' => $fav,
            'id' => $id
		]);

		return $update->rowCount();
    }

    public function remove_fav(int $fav, int $id){

        $sql = 'UPDATE vc_films SET fav = :f WHERE id=:id';
		
		$update = $this->co->prepare($sql);
		$update->execute([
            'f' => $fav,
            'id' => $id
		]);

		return $update->rowCount();
    }

    public function change_note(int $id, int $note){

        $sql = 'UPDATE vc_films SET note = :n WHERE id=:id';

        $update = $this->co->prepare($sql);
        $update->execute([
            'n' => $note,
            'id' => $id
        ]);

        return $update->rowCount();
    }
}