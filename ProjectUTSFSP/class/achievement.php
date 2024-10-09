<?php
require_once("database.php");

class achievement extends orangtua
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAchievement($search)
    {
        if ($search == "") {
            $sql = "SELECT achievement.idachievement, achievement.name AS achievement_name, 
            achievement.date, achievement.description, team.name AS team_name
            FROM achievement
            INNER JOIN team ON achievement.idteam = team.idteam";
            $statement = $this->koneksi->prepare($sql);
        } else {
            $sql_search = "%$search%";
            $sql = "SELECT achievement.idachievement, achievement.name AS achievement_name, 
                achievement.date, achievement.description, team.name AS team_name
                FROM achievement
                INNER JOIN team ON achievement.idteam = team.idteam
                WHERE team.name LIKE ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("s", $sql_search);
        }

        $statement->execute();

        $result = $statement->get_result();

        return $result;
    }

    public function getAchievementLimit($search, $offset = null, $limit = null)
    {
        if ($search == "") {
            $sql = "SELECT achievement.idachievement, achievement.name AS achievement_name, 
            achievement.date, achievement.description, team.name AS team_name
            FROM achievement
            INNER JOIN team ON achievement.idteam = team.idteam LIMIT ?, ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("ii", $offset, $limit);
        } else {
            $sql_search = "%$search%";
            $sql = "SELECT achievement.idachievement, achievement.name AS achievement_name, 
            achievement.date, achievement.description, team.name AS team_name
            FROM achievement
            INNER JOIN team ON achievement.idteam = team.idteam
            WHERE team.name LIKE ? LIMIT ?, ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->bind_param("sii", $sql_search, $offset, $limit);
        }

        $statement->execute();

        $result = $statement->get_result();

        return $result;
    }

    public function deleteAchievement($idAchievement)
    {
        $sql = "DELETE FROM achievement WHERE idachievement = ?";
        $statement = $this->koneksi->prepare($sql);
        $statement->bind_param("i", $idAchievement);

        if ($statement->execute()) {
            return true; // Berhasil dihapus
        } else {
            return false; // Gagal dihapus
        }
    }
}
