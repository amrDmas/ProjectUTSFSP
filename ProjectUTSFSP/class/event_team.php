<?php
require_once("database.php");

class eventTeam extends orangtua
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getEventTeam($search)
    {
        if ($search == "") {
            $sql = "SELECT e.name AS event_name, t.name AS team_name
        FROM event_teams et
        INNER JOIN event e ON et.idevent = e.idevent
        INNER JOIN team t ON et.idteam = t.idteam";
            $statement = $this->koneksi->prepare($sql);
        } else {
            $sql_search = "%$search%";
            $sql = "SELECT e.name AS event_name, t.name AS team_name
        FROM event_teams et
        INNER JOIN event e ON et.idevent = e.idevent
        INNER JOIN team t ON et.idteam = t.idteam
        WHERE e.name LIKE ? OR t.name LIKE ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("ss", $sql_search, $sql_search);
        }

        $statement->execute();
        return $statement->get_result();
    }

    public function getEventTeamLimit($search, $offset = null, $limit = null)
    {
        if ($search == "") {
            $sql = "SELECT e.name AS event_name, t.name AS team_name
        FROM event_teams et
        INNER JOIN event e ON et.idevent = e.idevent
        INNER JOIN team t ON et.idteam = t.idteam
        LIMIT ?, ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("ii", $offset, $limit);
        } else {
            $sql_search = "%$search%";
            $sql = "SELECT e.name AS event_name, t.name AS team_name
        FROM event_teams et
        INNER JOIN event e ON et.idevent = e.idevent
        INNER JOIN team t ON et.idteam = t.idteam
        WHERE e.name LIKE ? OR t.name LIKE ?
        LIMIT ?, ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("ssii", $sql_search, $sql_search, $offset, $limit);
        }

        $statement->execute();
        return $statement->get_result();
    }

    public function deleteEventTeam($idEventTeam)
    {
        $idEvent = substr($idEventTeam, 0, strpos($idEventTeam, "."));
        $idTeam = substr($idEventTeam, strpos($idEventTeam, ".") + 1);

        $sql = "DELETE FROM event_teams WHERE idevent=? AND idteam=?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $idEvent, $idTeam);

        if ($stmt->execute()) {
            return true; // Berhasil dihapus
            
            
        } else {
            return false; // Gagal dihapus
        }
    }
}
