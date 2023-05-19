<?php
    require("../validate_user.php");
    $mysqli = require("../conn_db.php");

    $arrIDT = $_POST["update"]["idt"];
    $arrNome = $_POST["update"]["nome"];
    $toDelete = $_POST["update"]["checkbox"];
    try {
        for($i = 0; $i < count($arrNome); $i++) {
            $updateTipo = "UPDATE Tipo
            SET nome='$arrNome[$i]'
            WHERE idt='$arrIDT[$i]'";

            $mysqli -> query($updateTipo);
        }

        $newidt = $_POST["new_idt"];
        $newnome = $_POST["new_nome"];

        if(!(strlen($newidt) == 0)) {
            $addTipo = "INSERT INTO Tipo(idt, nome)
            VALUES ('$newidt', '$newnome')";

            $result = $mysqli -> query($addTipo);

        }

        if(isset($toDelete)) {
            for($i = 0; $i < count($toDelete); $i++) {
                $queryDelete = "DELETE FROM Tipo
                WHERE idt='$toDelete[$i]'";
        
                $mysqli -> query($queryDelete);
            }
        }

        header("Location: ./impostazioni_nc.php?error=Successo");

    } catch (Exception $e) {
        header("Location: ./impostazioni_nc.php?error=Errore_Generico");
    }

?>