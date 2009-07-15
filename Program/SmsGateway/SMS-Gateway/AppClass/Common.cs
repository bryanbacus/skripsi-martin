using System;
using System.Collections.Generic;
using System.Text;

namespace Com.Martin.SMS.Common {

    public static class CommandProcessor {
        public static Com.Martin.SMS.Data.StructSMS ProcessRequest(Com.Martin.SMS.Data.StructSMS Request) {

            return Request;
        }

        // Private Parse SMS -> Command

        // Instance Command

        // Read Config


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
    }

    class ConfigLoader {

        public Com.Martin.SMS.Command.AbstractCommand CreateCommand(String CommandType, String CommandName) {
            throw new Com.Martin.SMS.Exception.SMSException();
        }
    }
}
