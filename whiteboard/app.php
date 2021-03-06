<?php
include 'config.php';

    class Cards extends Dbh {
        
        public function theCards($data){
            $getCards = $this->connect()->query("SELECT * FROM cards");
            $cardResults = $getCards->fetchAll();
            $getOptions = $this->connect()->query("SELECT * FROM card_status");
            $optionResults = $getOptions->fetchAll();
                        
            $cardTemplate = '';
                    $i = 1;
                foreach($cardResults as $card) {
                    
                    if($card['location'] == "$data"){
                        $settingsOptions ='';
                        $e = 1;
                        foreach($optionResults as $setting) {
                            $settingsOptions .= '
                                    <li>
                                    <input type="radio" value="'.$setting['id'].'" name="group'.$i.'" '.($card['status'] == $setting['id'] ? 'checked="checked"' : '').' />
                                    <label>'.$setting['status'].'</label>
                                    </li>
                            ';
                            $e++;
                        };
                    
                    $cardTemplate .= '
                    <div class="card" data-column="'.$card['location'].'" id="card-'.$card['id'].'">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 contenteditable="true">'.$card['title'].'</h3>
                            </div>
                            <div class="card-information">
                                <span class="notes-icon '.($card['note'] != '' || NULL ? '' : 'hide').'"><img src="images/note.png" alt="has note" title="Card has a note"  class="icon"/></span>
                                <span class="card-options"><img src="images/gear.png" class="icon"/></span>
                                <div class="options">
                                     <ul>'.$settingsOptions.'</ul>
                                </div> 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content" contenteditable="true">'.$card['note'].'</div>
                            <div class="clear-all '.($card['note'] != '' || NULL ? '' : 'hide').'"><button><img src="images/trashcan.png" alt="Delete Note" /><span>Delete Note<span></button></div>
                        </div>
                    </div>';
                    }
                    $i++;
                }
            echo $cardTemplate;
        }

        public function deleteCard($id){
            $conn = $this->connect()->prepare('DELETE FROM cards WHERE id=:id');
            $conn->bindParam(':id',$id); 
            $conn->execute();
        }

        public function addCard($title, $location){
            $conn = $this->connect()->prepare("INSERT INTO cards (`title`,`note`,`location`,`status`) 
                                            VALUES(:title,'',(select id from card_columns where column_names=:location limit 1), 1);");
            $conn->bindParam(':title',$title);
            $conn->bindParam(':location',$location);
            $conn->execute();
        }

        public function updateColumn($location,$id){
            $conn = $this->connect()->prepare('UPDATE cards SET location = (select id from card_columns where column_names=:location) WHERE id=:id limit 1');
            $conn->bindParam(':location',$location);
            $conn->bindParam(':id',$id);
            $conn->execute();
        }

        public function updateNote($message, $id){
            $conn = $this->connect()->prepare('UPDATE cards SET note=:message WHERE id=:id limit 1');
            $conn->bindParam(':message',$message);
            $conn->bindParam(':id',$id);
            $conn->execute();
        }

        public function updateTitle($title, $id){
            $conn = $this->connect()->prepare('UPDATE cards SET title=:title WHERE id=:id limit 1');
            $conn->bindParam(':title',$title);
            $conn->bindParam(':id',$id);
            $conn->execute();
        }

        public function updateOption($option, $id){
            $conn = $this->connect()->prepare('UPDATE cards SET status= :option WHERE id=:id  limit 1');
            $conn->bindParam(':option',$option);
            $conn->bindParam(':id',$id);
            $conn->execute();
        }
    };

    if(!empty($_POST['method'])){
        $method = empty($_POST['method'])   ? null : $_POST['method'];
        $id = empty($_POST['id'])   ? null : $_POST['id'];
        $location = empty($_POST['location'])   ? null : $_POST['location'];
        $message = empty($_POST['message'])   ? null : $_POST['message'];
        $title = empty($_POST['title'])   ? null : $_POST['title'];
        $option = empty($_POST['option'])   ? null : $_POST['option'];
       
        switch ($method) {
            case "delete":
                $delete = new Cards;
                $delete->deleteCard($id);
                break;
            case "new":
                $addCard = new Cards;
                $addCard->addCard($title, $location);
                break;
            case "update_col":
                $update_col = new Cards;
                $update_col->updateColumn($location, $id);
                break;
            case "note":
                $note = new Cards;
                $note->updateNote($message, $id);
                break;
            case "card_title":
                $theTitle = new Cards;
                $theTitle->updateTitle($title, $id);
                break;
            case "status":
                $status = new Cards;
                $status->updateOption($option, $id);
                break;
        }
    } else {
        $getCards = new Cards();
    }