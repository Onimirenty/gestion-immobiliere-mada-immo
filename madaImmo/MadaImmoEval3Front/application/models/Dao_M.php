<?php
class Dao_M extends CI_Model
{

    /*
    @author mirenty ratsimbazafy mirentybg4@gmail.com
    */
    public function refreshMV($view_name)
    {
        $sql = "REFRESH MATERIALIZED VIEW $view_name";
        $true = $this->db->query($sql);
        if ($true == false) {
            show_error(" tuhu ");
        }
    }
    function insert($table_name, $associative_array)
    {
        $str = $this->db->insert_string($table_name, $associative_array);
        return $this->db->query($str); //retourne 1
        /*
            exemple : 
            $nom ="mimi";
            $age = 666 ;
            $data = array('nom' => $nom, 'age'=>$age);
            echo $this->DaoModel->insert('personne',$data);
         */
    }
    public function update($table_name, $keyName, $associative_array)
    {
        $this->db->where($keyName, $associative_array["{$keyName}"]);
        return $this->db->update($table_name, $associative_array);
    }
    public function getAll($table_name)
    {
        $query = $this->db->get($table_name);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            log_message('error', "La table {$table_name} est vide.");
            return array();
        }
        /*
            exemple : 
            +   $toutes_les_personne =$this->DaoModel->selectWithCondition("personne");
                for($ligne=0;$i<count($toutes_les_personne);$ligne++)
                {
                    echo $toutes_les_personne[$ligne]['nomColonne'] ."<br>";
                }
        */
    }
    public function selectWithCondition($tableName, $condition = "1=1")
    {
        $query = "SELECT * FROM {$tableName} WHERE {$condition}";
        return $this->db->query($query)->result_array();
        /*
            exemple : 
            +   $toutes_les_personne =$this->DaoModel->selectWithCondition("personne");
                $personneRandom = $this->DaoModel->selectWithCondition("personne","nom like '%mi%' and age =18");
                si l'ensemble des personnes est de 1 ou mois alors condition est egale a $personneRandom
                $condition = ( count($toutes_les_personne) > 1 ) ? $toutes_les_personne : $personneRandom
                for($ligne=0;$i<count($condition);$ligne++)
                {
                    echo $condition[$ligne]['nom'] ."<br>";
                }
        */
    }
    public function deleteRows($tableName, $condition)
    {
        $query = "DELETE FROM {$tableName} WHERE {$condition}";
        return $this->db->query($query);
    }
    /*
        $lastUser = $this->lastRow('utilisateurs', 'id');
        $nomUtilisateur = $lastUser->nom_utilisateur;
    */
    public function lastRow($tableName, $primaryKeyColumn)
    {
        /* //obsolete
        if (empty($tableName) || empty($primaryKeyColumn)) {
            return false;
        }*/
        if (!is_string($tableName) || !is_string($primaryKeyColumn)) {
            log_message('error', 'Invalid parameters for lastRow function.');
            return false;
        }
        $this->db->order_by($primaryKeyColumn, 'desc');
        $this->db->limit(1);
        $query = $this->db->get($tableName);

        if ($query->num_rows() > 0) {
            $derniere_ligne = $query->row_array();
            return $derniere_ligne;
        } else {
            return false;
        }
    }

    public function reset_database()
    {
        // Exclude the admin table
        $exclude_tables = ['admin'];

        // Get the list of all tables
        $tables_query = $this->db->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE'");
        $tables = $tables_query->result_array();

        // Begin transaction
        $this->db->trans_begin();

        foreach ($tables as $table) {
            $table_name = $table['table_name'];
            if (!in_array($table_name, $exclude_tables)) {
                // Truncate the table
                $this->db->query("TRUNCATE TABLE \"$table_name\" RESTART IDENTITY CASCADE");
            }
        }

        // Commit or rollback based on the transaction status
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
    public function resetDatabase()
    {
        $sql = "do
        $$
        declare
            l_stmt text;
        begin
            select 'truncate ' || string_agg(format('%I.%I', schemaname, tablename), ',') || ' RESTART IDENTITY'
                into l_stmt
            from pg_tables
            where schemaname in ('public');
            execute l_stmt;
        end;
        $$";
        return $this->db->query($sql);
    }
    public function getTableInformation($tableName)
    {
        $query = " select cols.table_name, cols.column_name, cols.data_type, fk.foreign_table_name, fk.foreign_column_name, coalesce(fk.is_primary, 'false') as is_primary, coalesce(fk.is_foreign, 'false') as is_foreign from information_schema.columns as cols left join (SELECT tc.table_name, kcu.column_name, ccu.table_name AS foreign_table_name, ccu.column_name AS foreign_column_name, case when tc.constraint_type='PRIMARY KEY' then 'true' else 'false' end as is_primary, case when tc.constraint_type='FOREIGN KEY' then 'true' else 'false' end as is_foreign FROM information_schema.table_constraints AS tc JOIN information_schema.key_column_usage AS kcu ON tc.constraint_name = kcu.constraint_name AND tc.table_schema = kcu.table_schema JOIN information_schema.constraint_column_usage AS ccu ON ccu.constraint_name = tc.constraint_name WHERE tc.table_schema='public' AND tc.table_name='{$tableName}') as fk on cols.column_name=fk.column_name and cols.table_name=fk.table_name where cols.table_name='{$tableName}' ";
        return $this->db->query($query)->result_array();
        /*
         [0] => Array
        (
            [table_name] => client
            [column_name] => id_client
            [data_type] => integer
            [foreign_table_name] => client
            [foreign_column_name] => id_client
            [is_primary] => true
            [is_foreign] => false
        )

    [1] => Array
        (
            [table_name] => client
            [column_name] => nom
            [data_type] => character varying
            [foreign_table_name] => 
            [foreign_column_name] => 
            [is_primary] => false
            [is_foreign] => false
        ) 
         */
    }
    public function getAllTableName()
    {
        $query = " SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public' ";
        return $this->db->query($query)->result_array();
        /*
        ex : form :"Array
(
    [0] => Array
        (
            [tablename] => client
        )

    [1] => Array
        (
            [tablename] => societe
        )

    [2] => Array
        (
            [tablename] => ville
        )"
        */
    }
    // TODO a implementer correctement
    public function getById($tableName, $PkColName, $id)
    {
        $this->db->where($PkColName, $id);
        $query = $this->db->get($tableName);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            log_message('error', "La table {$tableName} est vide.");
            return array();
        }
    }
    public function get_repeated_emails($colName, $table_utilisateur, $groupeByClause)
    {
        $sql = "{$colName}, COUNT(*) as count";
        $this->db->select();
        $this->db->from("{$table_utilisateur}");
        $this->db->group_by("{$groupeByClause}");
        $this->db->having('count > 1');
        $query = $this->db->get();
        return $query->result();
    }
    // ToDo
    // public function row_exists($table, $conditions)
    // {
    //     return $this->Dao_M->selectWithCondition()
    // }

    /**
     * Execute a SELECT query with conditions and GROUP BY clause.
     *
     * @param string $tableName The name of the table to query.
     * @param string $columns Comma-separated list of columns to select.
     * @param string $condition The condition to apply in WHERE clause.
     * @param string $groupBy Optional GROUP BY clause.
     * @return array|null Returns the result set as an array of rows or null if no rows found.
     */
    public function selectWithGroupBy($tableName, $columns, $condition = "1=1", $groupBy = "")
    {
        $sql = "SELECT $columns FROM $tableName WHERE $condition";
        if (!empty($groupBy)) {
            $sql .= " GROUP BY $groupBy";
        }

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            log_message('error', "No rows found in table $tableName with condition: $condition");
            return null;
        }
    }
}
