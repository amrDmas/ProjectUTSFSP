<?php
    require_once("database.php");

    class event extends orangtua{

        public function __construct(){
            parent::__construct();
        }

        public function getEvent($search){
            if ($search == ""){
                $sql = "SELECT * FROM event";
                $statement = $this->koneksi->prepare($sql);
            } else{
                $sql_search = "%$search%";
                $sql = "SELECT * FROM event WHERE name LIKE ?";
                $statement = $this->koneksi->prepare($sql);
                $statement -> bind_param("s", $sql_search);
            }
        
            $statement->execute();
        
            $result = $statement->get_result();

            return $result;
        }

        public function getEventLimit($search, $offset = null, $limit = null){
            if ($search == ""){
                $sql = "SELECT * FROM event LIMIT ?, ?";
                $statement = $this->koneksi->prepare($sql);
                $statement -> bind_param("ii", $offset, $limit);
            } else{
                $sql_search = "%$search%";
                $sql = "SELECT * FROM event WHERE name LIKE ? LIMIT ?, ?";
                $statement = $this->koneksi->prepare($sql);
                $statement -> bind_param("sii", $sql_search, $offset, $limit);
            }
        
            $statement->execute();
        
            $result = $statement->get_result();

            return $result;
        }

        public function deleteEvent($idEvent) {
            $sql = "DELETE FROM event WHERE idevent = ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("i", $idEvent);
            
            if ($statement->execute()) {
                return true; // Berhasil dihapus
            } else {
                return false; // Gagal dihapus
            }
        }
    }
