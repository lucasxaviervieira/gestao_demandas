<?php

function deleteDemand($id)
{
    global $pdo;
    $sql = "DELETE FROM Controle_Demandas WHERE id = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ['message' => 'Demand deleted successfully'];
    } catch (PDOException $e) {
        return ['error' => 'Error deleting demand: ' . $e->getMessage()];
    }
}