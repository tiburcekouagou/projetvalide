<?php

/**
 * 
 */
class PortraitModel extends Connexion {

    /**
     * $conn
     */
    public $conn;

    
    public $title;
    public $image_name;
    public $text;
    public $ref_pro;

    
    public function insertPortrait($title, $image_name, $text, $ref_pro) {

        $this->title = $title;
        $this->image_name = $image_name;
        $this->text = $text;
        $this->ref_pro = $ref_pro;
        /**
         * 
         */
        $conn = $this->connect();
        /**
         * $sql
         */
        $sql = "INSERT INTO `hitec`.portrait VALUES(NULL, :title, :image_name, :texte, :reference)";
        /**
         * $stmt
         */
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":title" => $this->title,
            ":image_name" => $this->image_name,
            ":texte" => $this->text,
            ":reference" => $this->ref_pro,
        ]);
    }
    
    public function updatePortrait($title, $image_name, $text, $ref_pro) {

        $this->title = $title;
        $this->image_name = $image_name;
        $this->text = $text;
        $this->ref_pro = $ref_pro;
        /**
         * 
         */
        $conn = $this->connect();
        /**
         * $sql
         */
        $sql = "UPDATE `hitec`.portrait SET portrait_title = :title, portrait_image = :image_name, portrait_text = :texte WHERE reference = :reference";
        /**
         * $stmt
         */
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":title" => $this->title,
            ":image_name" => $this->image_name,
            ":texte" => $this->text,
            ":reference" => $this->ref_pro,
        ]);
    }

}