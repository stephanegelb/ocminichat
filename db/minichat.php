<?php

include_once __DIR__.'\db.php';

class minichat {
   function getMinichatDataFromDB() {
        $db = getDb();
        $sql = 'SELECT id, pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 10';
        $reponse = $db->query($sql);

        $array = array();
        while($data = $reponse->fetch()) {
            array_push($array, $this->getMinichatArray($data['id'], $data['pseudo'], $data['message']));
        }
        $reponse->closeCursor();

        return $array;
    } 
    
    public function setMinichatData($pseudo, $message) {
        $db = getDb();
        
        $statement = $db->prepare('INSERT INTO minichat (pseudo, message) VALUES (?,?)');
        $statement->execute(array($pseudo, $message));
    }

    public function getMinichatData() {
        $data = array();
        array_push($data, $this->getMinichatArray(1, 'Rene', "message 1 de Rene"));
        array_push($data, $this->getMinichatArray(2, 'René', "message 2 de Rene"));
        array_push($data, $this->getMinichatArray(3, 'René', "message 3 de René"));
    //    array_push($data, $this->getMinichatTable(1, "René", "message 2 de René"));
    //    array_push($data, $this->getMinichatTable(1, "Jean", "message 1 de Jean"));
    //    array_push($data, $this->getMinichatTable(1, "Maurice", "message 1 de Maurice"));
    //    array_push($data, $this->getMinichatTable(1, "Jean", "message 10 de Jean"));
        return $data;        
    }
    
    private function getMinichatArray($id, $pseudo, $message) {
        $data = array('id' => $id, 'pseudo' => htmlspecialchars($pseudo), 'message' => htmlspecialchars($message));
        return $data;
    }
}

