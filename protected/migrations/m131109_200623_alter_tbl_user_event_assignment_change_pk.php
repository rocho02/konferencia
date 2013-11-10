<?php

class m131109_200623_alter_tbl_user_event_assignment_change_pk extends CDbMigration {
    public function up() {
        $sql = array();
        $sql[] = "CREATE TABLE `tbl_user_event_assignment_temp` LIKE `tbl_user_event_assignment`;";
        $sql[] = "alter table `tbl_user_event_assignment_temp` drop primary key, add primary key (id_user,id_event,role);";
        $sql[] = "INSERT tbl_user_event_assignment_temp SELECT * FROM `tbl_user_event_assignment`;";
        $sql[] = "drop table `tbl_user_event_assignment`;";
        $sql[] = "CREATE TABLE `tbl_user_event_assignment` LIKE `tbl_user_event_assignment_temp`;";
        $sql[] = "INSERT `tbl_user_event_assignment` SELECT * FROM tbl_user_event_assignment_temp;";
        $sql[] = "drop table `tbl_user_event_assignment_temp`;";

        foreach ($sql as $s)
            $this -> execute($s);

    }

    public function down() {
         
    }

    /*
     // Use safeUp/safeDown to do migration with transaction
     public function safeUp()
     {
     }

     public function safeDown()
     {
     }
     */
}
