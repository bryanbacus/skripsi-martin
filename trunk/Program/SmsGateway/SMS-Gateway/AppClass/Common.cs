using System;
using System.Collections.Generic;
using System.Text;

namespace Com.Martin.SMS.Common {

    public static class CommandProcessor {

        public static Com.Martin.SMS.Data.SMSIncoming ProcessRequest(Com.Martin.SMS.Data.StructSMS Request) {

            return Request;
        }

        public static void ProcessBroadcast() {
        }

        public static void SendOutgoingSMS() {
        }
    }

    public class SMSHelper {

        public static Com.Martin.SMS.Data.SMSIncoming SaveIncomingMessage(String Sender, String Receiver, String Message) {
        }

        public static Com.Martin.SMS.Data.SMSIncoming GetIncomingMessage(String ID) {
        }

        public static void SaveOutgoingMessage(Com.Martin.SMS.Data.SMSOutgoing Outgoing) {
        }

        public static Com.Martin.SMS.Data.SMSOutgoing GetOutgoingMessage(String ID) {
        }

        public static void SaveBroadcastMessage(List<Com.Martin.SMS.Data.SMSOutgoing> OutgoingList) {
        }

        public static List<Com.Martin.SMS.Data.SMSOutgoing> GetOutgoingSMSList() {
        }

        public static List<Com.Martin.SMS.Data.BroadcastScheduler> GetBroadcastScheduler(DateTime NextExecute) {
        }
    }

    class ConfigLoader {
        private DB.DBProvider database = new Com.Martin.SMS.DB.DBProvider();

        public Com.Martin.SMS.Command.AbstractRequest CreateRequestCommand(String CommandType, String CommandName) {
            
            throw new Com.Martin.SMS.Exception.SMSException();
        }

        public Com.Martin.SMS.Command.AbstractBroadcast CreateBroadcastCommand(String CommandType, String CommandName) {
        }
    }
}
