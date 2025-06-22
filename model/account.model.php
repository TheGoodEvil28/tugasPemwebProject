<?php
class Account extends Model
{
    // Add XP calculation method
   public function getXP()
{
    $userId = $this->getActiveAccountId();
    $stmt = $this->db->prepare("SELECT xp_points FROM profiles WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['xp_points'] ?? 0;
}



    // Update existing getUserProfile to include XP
    public function getUserProfile()
{
    $userId = $this->getActiveAccountId();
    $stmt = $this->db->prepare("SELECT * FROM profiles WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    public function updateProfile($data)
{
    $userId = $this->getActiveAccountId();

    $fields = [];
    $values = [];

    foreach ($data as $key => $value) {
        $fields[] = "$key = ?";
        $values[] = $value;
    }

    $values[] = $userId;

    $sql = "UPDATE profiles SET " . implode(', ', $fields) . " WHERE id = ?";
    $stmt = $this->db->prepare($sql);

    return $stmt->execute($values);
}

}