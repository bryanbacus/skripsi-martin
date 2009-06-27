using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;

namespace Com.Martin.SMS.Command {
    public abstract class AbstractCommand {
        private Hashtable paramaters;

        public void AddParameter(String Key, String Value) {
        }
        public void ClearParameter() {
        }

        protected String GetParameter(String Key) {
            return String.Empty;
        }

        public abstract Com.Martin.SMS.Data.StructSMS ExecuteCommand(Com.Martin.SMS.Data.StructCommand Command);

    }
}
