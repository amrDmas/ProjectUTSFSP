<?php
require_once("database.php");

class team extends orangtua
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getTeam($search)
    {
        if ($search == "") {
            $sql = "SELECT t.name as team_name, g.name as game_name 
            FROM team t INNER JOIN game g ON t.idgame = g.idgame";
            $statement = $this->koneksi->prepare($sql);
        } else {
            $sql_search = "%$search%";
            $sql = "SELECT t.name as team_name, g.name as game_name 
            FROM team t INNER JOIN game g ON t.idgame = g.idgame WHERE t.name LIKE ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("s", $sql_search);
        }

        $statement->execute();

        $result = $statement->get_result();

        return $result;
    }

    public function getTeamLimit($search, $offset = null, $limit = null)
    {
        if ($search == "") {
            $sql = "SELECT t.name as team_name, g.name as game_name 
            FROM team t INNER JOIN game g ON t.idgame = g.idgame LIMIT ?, ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("ii", $offset, $limit);
        } else {
            $sql_search = "%$search%";
            $sql = "SELECT t.name as team_name, g.name as game_name 
            FROM team t INNER JOIN game g ON t.idgame = g.idgame WHERE t.name LIKE ? LIMIT ?, ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("sii", $sql_search, $offset, $limit);
        }

        $statement->execute();

        $result = $statement->get_result();

        return $result;
    }

    public function deleteTeam($idTeam)
    {
        $sql = "DELETE FROM team WHERE idteam = ?";
        $statement = $this->koneksi->prepare($sql);
        $statement->bind_param("i", $idTeam);

        if ($statement->execute()) {
            return true; // Berhasil dihapus
        } else {
            return false; // Gagal dihapus
        }
    }
}
