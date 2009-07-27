using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

using MySql.Data.MySqlClient;
using Com.Martin.SMS.DB;

namespace SMS_Gateway.FormBroadcastSchedule 
{
    public partial class FrmBroadcastSchedule : Form
    {
        public int brcdID = 0;
                
        public FrmBroadcastSchedule()
        {
            InitializeComponent();
            getCommandName();
        }

        private void FrmBroadcastSchedule_Load(object sender, EventArgs e)
        {
            this.Cmb_Status.SelectedIndex = 0; 
        }

        private void button2_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void getCommandName() 
        {
            DBProvider dbprovider = new DBProvider();

            MySqlCommand command = new MySqlCommand();


            String sqlCmd = "select reg_type,reg_name  from daftar_register order by reg_name";

            command.CommandText = sqlCmd;
            
            DataTable dtCommand = dbprovider.getData(command);

            if (dtCommand.Rows.Count > 0) {
              
                this.Cmb_Name.DataSource = dtCommand.DefaultView;
                this.Cmb_Name.DisplayMember = "reg_name";
                this.Cmb_Name.ValueMember = "reg_type";

                this.Cmb_Name.SelectedIndex = 0;
            }
        }

        private void Cmb_Name_SelectedIndexChanged(object sender, EventArgs e) {
            //MessageBox.Show(Cmb_Name.Text);          
        }

        public void showData(int jadwalID) {
            DBProvider dbprovider = new DBProvider();

            MySqlCommand command = new MySqlCommand();


            String sqlCmd = "select * from jadwal_broadcast where id_jadwal=?id_jadwal";

            command.CommandText = sqlCmd;
            command.Parameters.Add(new MySqlParameter("id_jadwal", jadwalID));

            DataTable dtCommand = dbprovider.getData(command);

            if (dtCommand.Rows.Count > 0) {
                DataRow row = dtCommand.Rows[0];

                Cmb_Name.SelectedValue = row["reg_type"].ToString();
                Cmb_Name.Text = row["reg_name"].ToString();
                this.Txt_MaxLoop.Text = row["pengulangan_max"].ToString();
                this.Txt_CurrLoop.Text = row["pengulangan_hitung"].ToString();

                this.Txt_Interval.Text = row["pengulangan_interval_hari"].ToString();
                this.dtNextExecute.Value =  DateTime.Parse(row["waktu_eksekusi_lanjut"].ToString());
                this.dtLastExecute.Value = DateTime.Parse(row["waktu_eksekusi_terakhir"].ToString());
                this.Cmb_Status.Text = row["status"].ToString();


            }
        }

        public void deleteData(int jadwallID) {
            DBProvider dbprovider = new DBProvider();

            MySqlCommand command = new MySqlCommand();

            String sqlCmd = "DELETE FROM `jadwal_broadcast` ";
            sqlCmd += "WHERE CONVERT(`jadwal_broadcast`.`id_jadwal` ) = ?id_jadwal  ";
            command.CommandText = sqlCmd;
            command.Parameters.Clear();
            command.Parameters.Add(new MySqlParameter("id_jadwal", jadwallID));

            dbprovider.Exec(command);
        }

        private void btnSave_Click(object sender, EventArgs e) {
            MySqlCommand command = new MySqlCommand();
            DBProvider dbProvider = new DBProvider();

            String sqlCmd = "select * from `jadwal_broadcast` where id_jadwal=?id_jadwal";

            command.Parameters.Clear();
            command.Parameters.Add(new MySqlParameter("id_jadwal", brcdID));
           
            command.CommandText = sqlCmd;
            DataTable dtCommand = dbProvider.getData(command);

            if (dtCommand.Rows.Count > 0) {
                command.CommandText = " update `jadwal_broadcast`  set ";
                command.CommandText += " `id_jadwal`=?id_jadwal,";
                command.CommandText += " `reg_type`=?reg_type,";
                command.CommandText += " `reg_name`=?reg_name,";
                command.CommandText += " `pengulangan_max`=?pengulangan_max,";
                command.CommandText += " `pengulangan_hitung`=?pengulangan_hitung, ";
                command.CommandText += " `pengulangan_interval_hari`=?pengulangan_interval_hari, ";
                command.CommandText += " `waktu_eksekusi_lanjut`=?waktu_eksekusi_lanjut, ";
                command.CommandText += " `waktu_eksekusi_terakhir`=?waktu_eksekusi_terakhir,";
                command.CommandText += " `status`=?status";
                command.CommandText += " where `id_jadwal`=?id_jadwal";
            }
            else {

                command.Parameters.Clear();
                command.Parameters.Add(new MySqlParameter("id_jadwal", null));

                command.CommandText = "INSERT INTO `jadwal_broadcast` ";
                command.CommandText += "( `id_jadwal` , `reg_type` , `reg_name` , `pengulangan_max` , `pengulangan_hitung` , `pengulangan_interval_hari` , `waktu_eksekusi_lanjut` , `waktu_eksekusi_terakhir` , `status` ) ";
                command.CommandText += "VALUES ( ?id_jadwal,?reg_type , ?reg_name , ?pengulangan_max, ?pengulangan_hitung, ?pengulangan_interval_hari,?waktu_eksekusi_lanjut ,?waktu_eksekusi_terakhir,?status )";
            }

            command.Parameters.Add(new MySqlParameter("reg_type", this.Cmb_Name.SelectedValue.ToString()));
            command.Parameters.Add(new MySqlParameter("reg_name", this.Cmb_Name.Text));
            command.Parameters.Add(new MySqlParameter("pengulangan_max", this.Txt_MaxLoop.Text));
            command.Parameters.Add(new MySqlParameter("pengulangan_hitung", this.Txt_CurrLoop.Text));
            command.Parameters.Add(new MySqlParameter("pengulangan_interval_hari", this.Txt_Interval.Text));
            command.Parameters.Add(new MySqlParameter("waktu_eksekusi_lanjut", this.dtNextExecute.Value.ToString("yyyy-MM-dd HH:mm:ss")));
            command.Parameters.Add(new MySqlParameter("waktu_eksekusi_terakhir", this.dtLastExecute.Value.ToString("yyyy-MM-dd HH:mm:ss")));
            command.Parameters.Add(new MySqlParameter("status", this.Cmb_Status.Text));

            dbProvider.Exec(command);
            dbProvider.dbClose();
        }

    }
}