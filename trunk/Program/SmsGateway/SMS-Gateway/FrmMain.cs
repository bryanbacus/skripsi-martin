using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

using Microsoft.VisualBasic;

using ATSMS;
using ATSMS.Common;
using ATSMS.SMS.Decoder;
using ATSMS.SMS.Encoder;

using SMS_Gateway.AppClass;

namespace SMS_Gateway
{
    public partial class FrmMain : Form
    {
        private GSMModem oGsmModem = new GSMModem();
       
        private String dialogCaption = "SMS Gateway";
        public FrmMain()
        {
            InitializeComponent();
        }

        private void oGsmModem_NewMessageReceived(ATSMS.NewMessageReceivedEventArgs e)
        {
            //txtMsg.Text = "Message from " + e.MSISDN + ". Message - " + e.TextMessage + ControlChars.CrLf;
        }

        private void btnConnect_Click(object sender, EventArgs e)
        {
            if (oGsmModem.IsConnected) {
                MessageBox.Show("Already Connected, please close connection", dialogCaption, MessageBoxButtons.OK);
                return;
            }

            if (cboComPort.Text == string.Empty)
            {
                MessageBox.Show("COM Port must be selected", dialogCaption, MessageBoxButtons.OK);
                return;
            }
            oGsmModem.Port = cboComPort.Text;

            if (cboBaudRate.Text != string.Empty)
            {
                oGsmModem.BaudRate = Convert.ToInt32(cboBaudRate.Text);
            }

            if (cboDataBit.Text != string.Empty)
            {
                oGsmModem.DataBits = Convert.ToInt32(cboDataBit.Text);
            }

            if (cboStopBit.Text != string.Empty)
            {
                switch (cboStopBit.Text)
                {
                    case "1":
                        oGsmModem.StopBits = ATSMS.Common.EnumStopBits.One;
                        break;
                    case "1.5":
                        oGsmModem.StopBits = ATSMS.Common.EnumStopBits.OnePointFive;
                        break;
                    case "2":
                        oGsmModem.StopBits = ATSMS.Common.EnumStopBits.Two;
                        break;
                }
            }

            if (cboFlowControl.Text != string.Empty)
            {
                switch (cboFlowControl.Text)
                {
                    case "None":
                        oGsmModem.FlowControl = ATSMS.Common.EnumFlowControl.None;
                        break;
                    case "Hardware":
                        oGsmModem.FlowControl = ATSMS.Common.EnumFlowControl.RTS_CTS;
                        break;
                    case "Xon/Xoff":
                        oGsmModem.FlowControl = ATSMS.Common.EnumFlowControl.Xon_Xoff;
                        break;
                }
            }
            
            try
            {
                oGsmModem.Connect();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message, dialogCaption, MessageBoxButtons.OK);
                return;
            }
            btnConnect.Enabled = false;
            btnDisconnect.Enabled = true;
            btnDiagnostic.Enabled = true;
        }

        private void btnDisconnect_Click(object sender, EventArgs e)
        {
            if (oGsmModem.IsConnected)
            {
                oGsmModem.Disconnect();
            }
            btnConnect.Enabled = true; 
            btnDisconnect.Enabled = false;
            btnDiagnostic.Enabled = false;
        }

        private void btnDiagnostic_Click(object sender, EventArgs e)
        {
            if (oGsmModem.IsConnected)
            {
                FrmDiagnostic frmDiag = new FrmDiagnostic();
                this.Cursor = Cursors.WaitCursor;
                frmDiag.getModemDetails(oGsmModem); 
                frmDiag.ShowDialog();
                this.Cursor = Cursors.Default;
            }
            else 
            {
                MessageBox.Show("Modem is not connected", dialogCaption, MessageBoxButtons.OK);
            }
        }

        private void Btn_Close_Click(object sender, EventArgs e)
        {   
            if (oGsmModem.IsConnected) 
            { 
                oGsmModem.Disconnect(); 
            }
            this.Close();
        }

        private void FrmMain_Load(object sender, EventArgs e)
        {
            btnConnect.Enabled = true;
            btnDisconnect.Enabled = false;
            btnDiagnostic.Enabled = false;
        }

        private void chkTab() 
        {
            if (oGsmModem.IsConnected)
            { 
                
            }
        }
    }
}