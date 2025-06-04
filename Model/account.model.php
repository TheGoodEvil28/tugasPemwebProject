<?php
class Account extends Model
{
    // Add XP calculation method
    public function getXP()
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("
            SELECT xp_points FROM profiles WHERE id = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['xp_points'] ?? 0;
    }

    // Update existing getUserProfile to include XP
    public function getUserProfile()
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("SELECT * FROM profiles WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateProfile($data)
    {
        $userId = $this->getActiveAccountId();

        // Build dynamic query
        $fields = [];
        $types = '';
        $values = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $types .= 's';
            $values[] = $value;
        }

        $values[] = $userId;  // Add userId as last parameter
        $types .= 'i';        // Add integer type for userId

        $sql = "UPDATE profiles SET " . implode(', ', $fields) . " WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($types, ...$values);

        return $stmt->execute();
    }
}
