<?php
require_once("database.php");

class game extends orangtua
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getGame($search)
    {
        if ($search == "") {
            $sql = "SELECT * FROM game";
            $statement = $this->koneksi->prepare($sql);
        } else {
            $sql_search = "%$search%";
            $sql = "SELECT * FROM game WHERE name LIKE ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("s", $sql_search);
        }

        $statement->execute();

        $result = $statement->get_result();

        return $result;
    }

    public function getGameLimit($search, $offset = null, $limit = null)
    {
        if ($search == "") {
            $sql = "SELECT * FROM game LIMIT ?, ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("ii", $offset, $limit);
        } else {
            $sql_search = "%$search%";
            $sql = "SELECT * FROM game WHERE name LIKE ? LIMIT ?, ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("sii", $sql_search, $offset, $limit);
        }

        $statement->execute();

        $result = $statement->get_result();

        return $result;
    }

    public function deleteGame($idGame)
    {
        $sql = "DELETE FROM game WHERE idgame = ?";
        $statement = $this->koneksi->prepare($sql);
        $statement->bind_param("i", $idGame);

        if ($statement->execute()) {
            return true; // Berhasil dihapus
        } else {
            return false; // Gagal dihapus
        }
    }
}
